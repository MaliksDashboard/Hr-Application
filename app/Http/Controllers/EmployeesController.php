<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;
use App\Models\Branch;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Title;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

use ZipArchive;
use function Laravel\Prompts\table;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('status', 'desc') // Order by status: 1 first, then 0
            ->orderBy('branch_id', 'asc') // Then order by branch_id ascending
            ->get();

        $branches = Branch::orderBy('branch_name', 'asc')->get();

        return view('employees.index', compact('employees', 'branches'));
    }
    public function create()
    {
        $branches = Branch::orderBy('branch_name', 'asc')->get();
        $titles = Title::pluck('name')->toArray();
        $jobs = DB::table('employee_info')->distinct()->pluck('job');
        return view('employees.create', compact('branches', 'titles', 'jobs'));
    }

    public function store(Request $request)
    {
        // Log the incoming request data
        Log::info('Store method called with data: ', $request->all());

        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'title' => 'required|string|max:255',
            'status' => 'required|in:on,off',
            'date_hired' => ['required', 'date', 'before:today'],
            'pin_code' => 'required|string|max:255|unique:employee_info,pin_code',
            'email' => 'required|email|unique:employee_info,email',
            'phone' => 'nullable|string|max:15|unique:employee_info,phone',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'job' => 'required|string|max:255',
        ]);

        Log::info('Validated data: ', $validatedData);

        // Check if title exists and insert if not
        $existingTitle = DB::table('employee_info')->where('title', $request->title)->exists();
        if (!$existingTitle) {
            DB::table('employee_info')->insert(['title' => $request->title]);
        }

        // Handle image upload
        $storedImagePath = null;
        if ($request->hasFile('image')) {
            try {
                Log::info('Image uploaded: ', [$request->file('image')]);

                $manager = new ImageManager(new Driver());
                $image = $request->file('image');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img = $img->resize(370, 370);
                $savePath = storage_path('app/public/images/' . $filename);
                $img->toJpeg(80)->save($savePath);
                $storedImagePath = 'images/' . $filename;
            } catch (\Exception $e) {
                Log::error('Image processing failed: ' . $e->getMessage());
                return redirect()->back()->withErrors('Image upload failed. Please try again.');
            }
        }

        // Create employee record in the database
        $employee = Employee::create([
            'name' => $validatedData['name'],
            'branch_id' => $validatedData['branch_id'],
            'title' => $validatedData['title'],
            'status' => $validatedData['status'] === 'on',
            'date_hired' => $validatedData['date_hired'],
            'pin_code' => $validatedData['pin_code'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'image_path' => $storedImagePath ?? null,
            'job' => $validatedData['job'],
        ]);

        // Create folder for employee in employees-data
        $folderName = "{$employee->name}-{$employee->pin_code}";
        $folderPath = "employees-data/$folderName";

        // Explicitly use the public disk
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
            Log::info("Created folder: $folderPath");
        } else {
            Log::warning("Folder already exists: $folderPath");
        }

        $creator = Auth::user();

        // Notify all admins about the new employee except the creator
        $adminUsers = User::role('Admin')->get();
        foreach ($adminUsers as $admin) {
            if ($admin->id !== $creator->id) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_alert',
                    'message' => "{$creator->name} has created a new employee named {$employee->name} with the job of {$employee->job}.",
                    'notified_at' => now(),
                    'is_read' => false,
                    'user_image' => $creator->image ?? '/images/Default.jpg',
                ]);
            }
        }

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $branches = Branch::orderBy('branch_name', 'asc')->get();
        $titles = Title::pluck('name');
        $jobs = DB::table('employee_info')->distinct()->pluck('job');
        $employee = Employee::findOrFail($id);

        return view('employees.edit', compact('branches', 'employee', 'titles', 'jobs'));
    }

    public function update(Request $request, Employee $employee)
    {
        // Log the incoming request data
        Log::info('Update method called with data: ', $request->all());

        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'title' => 'required|string|max:255',
            'status' => 'required|in:on,off',
            'date_hired' => ['required', 'date', 'before:today'],
            'pin_code' => 'required|string|max:255|unique:employee_info,pin_code,' . $employee->id,
            'email' => 'required|email|unique:employee_info,email,' . $employee->id,
            'phone' => 'nullable|string|max:15|unique:employee_info,phone,' . $employee->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'job' => 'required|string|max:255',
            'left_date' => [
                'nullable',
                'date',
                'after_or_equal:date_hired',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->status === 'on' && $value) {
                        $fail("The {$attribute} field must be empty when the employee is active.");
                    }
                },
            ], // Validate left_date only if status is 'off'
        ]);

        Log::info('Validated data: ', $validatedData);

        // Rename the employee folder if name or PIN code changes
        $oldFolderName = "{$employee->name}-{$employee->pin_code}";
        $newFolderName = "{$validatedData['name']}-{$validatedData['pin_code']}";
        $oldFolderPath = "employees-data/$oldFolderName";
        $newFolderPath = "employees-data/$newFolderName";

        if ($oldFolderName !== $newFolderName) {
            // Check if the old folder exists and rename it
            if (Storage::disk('public')->exists($oldFolderPath)) {
                Storage::disk('public')->move($oldFolderPath, $newFolderPath);
                Log::info("Renamed folder from $oldFolderPath to $newFolderPath");
            } else {
                Log::warning("Old folder not found: $oldFolderPath. Creating a new one.");
                Storage::disk('public')->makeDirectory($newFolderPath);
            }
        }

        // Update image if provided
        if ($request->hasFile('image')) {
            try {
                Log::info('Image uploaded: ', [$request->file('image')]);

                $manager = new ImageManager(new Driver());
                $image = $request->file('image');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img = $img->resize(370, 370);
                $savePath = storage_path('app/public/images/' . $filename);
                $img->toJpeg(80)->save($savePath);

                // Update the stored image path
                $employee->image_path = 'images/' . $filename;
            } catch (\Exception $e) {
                Log::error('Image processing failed: ' . $e->getMessage());
                return redirect()->back()->withErrors('Image upload failed. Please try again.');
            }
        }

        // Log data before saving to the database
        Log::info('Data to be updated: ', [
            'name' => $validatedData['name'],
            'branch_id' => $validatedData['branch_id'],
            'title' => $validatedData['title'],
            'status' => $validatedData['status'] === 'on',
            'date_hired' => $validatedData['date_hired'],
            'pin_code' => $validatedData['pin_code'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'image_path' => $employee->image_path,
            'job' => $validatedData['job'],
            'left_date' => $validatedData['status'] === 'on' ? null : $validatedData['left_date'], // Log left_date
        ]);

        // Update the employee record
        $employee->update([
            'name' => $validatedData['name'],
            'branch_id' => $validatedData['branch_id'],
            'title' => $validatedData['title'],
            'status' => $validatedData['status'] === 'on',
            'date_hired' => $validatedData['date_hired'],
            'pin_code' => $validatedData['pin_code'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'image_path' => $employee->image_path, // This now includes the new image path if updated
            'job' => $validatedData['job'],
            'left_date' => $validatedData['status'] === 'on' ? null : $validatedData['left_date'], // Ensure left_date is included
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        Log::info('Attempting to Delete Employee: ', ['id' => $employee->id]);

        $creator = Auth::user();

        $job = $employee->job ?? 'N/A';
        $branchName = $employee->branch->branch_name ?? 'N/A';

        $adminUsers = User::role('Admin')->get();
        foreach ($adminUsers as $admin) {
            if ($admin->id !== $creator->id) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_alert',
                    'message' => "{$creator->name} has deleted the employee named {$employee->name}, who was working as {$job} at {$branchName}.",
                    'notified_at' => now(),
                    'is_read' => false,
                    'user_image' => $creator->image ?? '/images/Default.jpg',
                ]);
            }
        }

        if ($employee->image_path && Storage::disk('public')->exists($employee->image_path)) {
            Storage::disk('public')->delete($employee->image_path);
            Log::info('Image deleted successfully:', ['image_path' => $employee->image_path]);
        }

        $employee->delete();
        Log::info('Employee deleted successfully:', ['id' => $employee->id]);

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        // Get the selected IDs from the request
        $ids = explode(',', $request->input('selected_ids'));

        // Log the IDs being processed
        Log::info('Received IDs for deletion: ' . implode(',', $ids));

        if (empty($ids) || count($ids) === 0) {
            return redirect()->route('employees.index')->with('error', 'No employees selected for deletion.');
        }

        foreach ($ids as $id) {
            $employee = Employee::find($id);

            if (!$employee) {
                Log::warning('Employee not found with ID: ' . $id);
                continue; // Skip if the employee is not found
            }

            // Log the employee being deleted
            Log::info('Deleting employee: ' . $employee->name);

            // Delete the image file if it exists
            if ($employee->image_path && Storage::exists($employee->image_path)) {
                Storage::delete($employee->image_path);
                Log::info('Deleted image file: ' . $employee->image_path);
            }

            // Delete the employee record
            $employee->delete();
        }

        return redirect()->route('employees.index')->with('success', 'Selected employees deleted successfully.');
    }

    public function getEmployeeInfo()
    {
        $employees = Employee::with('branch')->get();

        // Transform data to include branch_name
        $employees = $employees->map(function ($employee) {
            return [
                'id' => $employee->id,
                'name' => $employee->name,
                'branch_name' => $employee->branch->branch_name ?? 'N/A',
                'title' => $employee->title,
                'phone' => $employee->phone,
                'email' => $employee->email,
                'date_hired' => $employee->date_hired,
                'image_path' => $employee->image_path,
                'status' => $employee->status,
                'pin_code' => $employee->pin_code,
            ];
        });

        return response()->json($employees);
    }

    public function getEmployeeFiles($employeeName, $pinCode)
    {
        // Folder inside public/storage
        $folderName = "$employeeName-$pinCode";
        $folderPath = "employees-data/$folderName"; // Adjust path for public/storage

        // Use Storage::disk('public') for proper access
        if (!Storage::disk('public')->exists($folderPath)) {
            Log::error("Folder not found: $folderPath");
            return response()->json(['files' => [], 'message' => "No files found for $folderName"], 404);
        }

        // Get all files in the folder
        $files = Storage::disk('public')->files($folderPath);

        // Prepare file data
        $fileDetails = [];
        foreach ($files as $file) {
            $fileDetails[] = [
                'name' => basename($file),
                'size' => round(Storage::disk('public')->size($file) / 1024, 2) . ' KB', // File size in KB
                'url' => asset('storage/' . $file), // Generate URL explicitly
            ];
        }

        return response()->json(['files' => $fileDetails]);
    }

    public function downloadAllFiles($employeeName, $pinCode)
    {
        $folderName = "$employeeName-$pinCode";
        $folderPath = "employees-data/$folderName";

        // Log the folder being checked
        Log::info("Checking folder: $folderPath");

        // Check if folder exists
        if (!Storage::disk('public')->exists($folderPath)) {
            Log::error("Folder not found: $folderPath");
            return response()->json(['message' => "No files found for $folderName"], 404);
        }

        $files = Storage::disk('public')->files($folderPath);

        if (empty($files)) {
            Log::info("No files found in: $folderPath");
            return response()->json(['message' => "No files found for $folderName"], 404);
        }

        $zipFileName = "$folderName.zip";
        $zipFilePath = storage_path("app/public/temp/$zipFileName");

        // Ensure the temp directory exists
        if (!file_exists(storage_path('app/public/temp'))) {
            mkdir(storage_path('app/public/temp'), 0755, true);
        }

        $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($files as $file) {
                $absolutePath = storage_path("app/public/$file"); // Full path for the file
                $relativeName = basename($file); // Add only the file name to the zip
                $zip->addFile($absolutePath, $relativeName);
            }
            $zip->close();
        } else {
            Log::error("Failed to create ZIP file: $zipFilePath");
            return response()->json(['message' => 'Failed to create ZIP file'], 500);
        }

        // Return the zip file for download
        return response()->download($zipFilePath)->deleteFileAfterSend();
    }

    public function uploadFiles(Request $request)
    {
        $employeeName = $request->input('employeeName');
        $pinCode = $request->input('pinCode');
        $folderName = "$employeeName-$pinCode";
        $folderPath = "employees-data/$folderName";

        if (!$request->hasFile('files')) {
            return response()->json(['message' => 'No files provided'], 400);
        }

        $files = $request->file('files');
        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            try {
                Storage::disk('public')->putFileAs($folderPath, $file, $fileName);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to upload file'], 500);
            }
        }

        return response()->json(['message' => 'Files uploaded successfully'], 200);
    }
    public function delete(Request $request)
    {
        $validated = $request->validate([
            'employeeName' => 'required|string',
            'pinCode' => 'required|string',
            'fileName' => 'required|string',
        ]);

        $folderPath = 'employees-data/' . $validated['employeeName'] . '-' . $validated['pinCode'];
        $filePath = $folderPath . '/' . $validated['fileName'];

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            session()->flash('success', 'File deleted successfully.');
            return response()->json(['redirect' => route('employees.index')], 200);
        }

        session()->flash('error', 'File not found.');
        return response()->json(['redirect' => route('employees.index')], 404);
    }
}
