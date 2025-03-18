<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Job;
use App\Models\User;
use App\Models\Title;
use App\Models\Branch;
use App\Models\Vacancy;
use App\Models\Employee;
use App\Models\Notification;
use App\Events\NewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        // Search Filter (DOES NOT exclude employees with status = 0)
        if ($request->has('search') && !empty($request->search)) {
            $searchTerms = explode(' ', trim($request->search));

            $query->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->where(function ($subQuery) use ($term) {
                        $subQuery
                            ->where('name', 'LIKE', "%{$term}%")
                            ->orWhereHas('branch', function ($bQuery) use ($term) {
                                $bQuery->where('branch_name', 'LIKE', "%{$term}%");
                            })
                            ->orWhere('title', 'LIKE', "%{$term}%")
                            ->orWhereHas('jobRelation', function ($jQuery) use ($term) {
                                $jQuery->where('name', 'LIKE', "%{$term}%");
                            })
                            ->orWhere('pin_code', 'LIKE', "%{$term}%");
                    });
                }
            });
        }

        // Branch Filter (EXCLUDES status = 0)
        if ($request->has('branch') && !empty($request->branch)) {
            $query->where('branch_id', $request->branch)
                ->where('status', '!=', 0);
        }

        // Job Filter (EXCLUDES status = 0)
        if ($request->has('job') && !empty($request->job)) {
            $query->whereHas('jobRelation', function ($jQuery) use ($request) {
                $jQuery->where('id', $request->job);
            })->where('status', '!=', 0);
        }

        // Final Query Execution
        $employees = $query
            ->with(['jobRelation'])
            ->orderBy('status', 'desc')
            ->orderBy('branch_id', 'asc')
            ->paginate(20);


        // Debug: Check if the job is actually being loaded
        foreach ($employees as $employee) {
            Log::info([
                'employee_id' => $employee->id,
                'job_id' => $employee->job,
                'job_is_object' => is_object($employee->job) ? 'YES' : 'NO',
                'job_class' => is_object($employee->job) ? get_class($employee->job) : 'Not an object',
                'job_name' => is_object($employee->job) ? $employee->job->name : 'Not an object',
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'employees' => view('partials.employee_cards', compact('employees'))->render(),
                'next_page' => $employees->nextPageUrl(),
            ]);
        }

        $branches = Branch::orderBy('branch_name', 'asc')->get();
        $jobs = Job::all();

        return view('employees.index', compact('employees', 'branches', 'jobs'));
    }

    public function create()
    {
        $branches = Branch::orderBy('branch_name', 'asc')->get();
        $titles = Title::pluck('name')->toArray();
        $jobs = Job::all();
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
            'date_hired' => ['required', 'date', 'before_or_equal:today'],
            'pin_code' => 'required|string|digits:4|unique:employee_info,pin_code',
            'email' => 'nullable|email|unique:employee_info,email',
            'phone' => 'nullable|string|max:15|unique:employee_info,phone',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'job' => 'required|string|max:255',
            'car' => 'nullable|in:No,Yes,Moto,Both',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'blood_type' => 'nullable|string|max:10',
            'marital_status' => 'nullable|in:Single,Married,Divorced',
            'shift' => 'required|in:Full Time,Part Time',
            'whish_number' => 'nullable|string|max:255',
            'where_can_work' => 'nullable|string|max:500', // Allowing multiple branches as comma-separated values
            'left_date' => 'nullable|date|after:date_hired',
            'left_reason' => 'nullable|string|max:255',
            'give_notice' => 'nullable|boolean',
            'is_good_performer' => 'nullable|boolean',
            'is_positive_person' => 'nullable|boolean',
            'exit_interview_remarks' => 'nullable|string|max:500',
            'is_recommended_to_back' => 'nullable|boolean',
        ]);

        // ✅ Handle Multi-Selection for "where_can_work"
        if ($request->has('where_can_work') && is_array($request->where_can_work)) {
            $validatedData['where_can_work'] = implode(',', $request->where_can_work);
        }

        Log::info('Validated data: ', $validatedData);

        // Check if title exists and insert if not
        $existingTitle = DB::table('employee_info')->where('title', $request->title)->exists();
        if (!$existingTitle) {
            DB::table('employee_info')->insert([
                'name' => $request->name,
                'title' => $request->title,
                'branch_id' => $request->branch_id,
                'status' => $request->status === 'on',
                'date_hired' => $request->date_hired,
                'pin_code' => $request->pin_code,
                'email' => $request->email,
                'phone' => $request->phone,
                'job' => $request->job,
                'image_path' => $request->image ?? '/images/Default.jpg',
                'car' => $request->car,
                'address' => $request->address,
                'birthday' => $request->birthday,
                'blood_type' => $request->blood_type ?? null,
                'marital_status' => $request->marital_status ?? 'Single',
                'shift' => $request->shift ?? 'Full Time',
                'whish_number' => $request->whish_number ?? null,
                'where_can_work' => isset($request->where_can_work) ? implode(',', (array) $request->where_can_work) : null,
                'left_date' => $request->left_date ?? null,
                'left_reason' => $request->left_reason ?? null,
                'give_notice' => $request->give_notice ?? null,
                'is_good_performer' => $request->is_good_performer ?? null,
                'is_positive_person' => $request->is_positive_person ?? null,
                'exit_interview_remarks' => $request->exit_interview_remarks ?? null,
                'is_recommended_to_back' => $request->is_recommended_to_back ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ✅ Handle image upload
        $storedImagePath = null;
        if ($request->hasFile('image')) {
            try {
                Log::info('Image uploaded: ', [$request->file('image')]);

                $manager = new ImageManager(new Driver());
                $image = $request->file('image');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                $img = $manager->read($image);

                // ✅ Keep the original width & height
                $width = $img->width();
                $height = $img->height();
                $img = $img->resize($width, $height); // This does nothing but ensures dimensions remain the same

                $savePath = storage_path('app/public/images/' . $filename);

                // ✅ Reduce file size by lowering JPEG quality (60 instead of 80)
                $img->toJpeg(60)->save($savePath);

                $storedImagePath = 'images/' . $filename;
            } catch (\Exception $e) {
                Log::error('Image processing failed: ' . $e->getMessage());
                return redirect()->back()->withErrors('Image upload failed. Please try again.');
            }
        }

        // ✅ Create employee record in the database
        $employee = Employee::create([
            'name' => $request->name,
            'branch_id' => $request->branch_id,
            'title' => $request->title,
            'status' => $request->status === 'on',
            'date_hired' => $request->date_hired,
            'pin_code' => $request->pin_code,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'image_path' => $storedImagePath ?? '/images/Default.jpg',
            'job' => $request->job,
            'car' => $request->car ?? null,
            'address' => $request->address ?? null,
            'birthday' => $request->birthday ?? null,
            'blood_type' => $request->blood_type ?? null,
            'marital_status' => $request->marital_status ?? 'Single',
            'shift' => $request->shift ?? 'Full Time',
            'whish_number' => $request->whish_number ?? null,
            'where_can_work' => isset($request->where_can_work) ? implode(',', (array) $request->where_can_work) : null,
            'left_date' => $request->left_date ?? null,
            'left_reason' => $request->left_reason ?? null,
            'give_notice' => $request->give_notice ? 1 : 0,
            'is_good_performer' => $request->is_good_performer ? 1 : 0,
            'is_positive_person' => $request->is_positive_person ? 1 : 0,
            'exit_interview_remarks' => $request->exit_interview_remarks ?? null,
            'is_recommended_to_back' => $request->is_recommended_to_back ? 1 : 0,
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
                $notification = Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_alert',
                    'message' => "{$creator->name} has created a new employee named {$employee->name} with the job of {$employee->jobRelation->name}.",
                    'notified_at' => now(),
                    'is_read' => false,
                    'user_image' => $creator->image ?? '/images/Default.jpg',
                ]);

                // Broadcast notification to other users in real-time
                broadcast(new NewNotification($notification))->toOthers();
            }
        }

        $defaultPassword = 'Welcome@123';

        $user = User::create([
            'employee_id' => $employee->id, // Make sure to use $employee->id here, not $validatedData['id']
            'name' => $validatedData['name'],
            'email' => $validatedData['email'] ?? null,
            'password' => bcrypt($defaultPassword),
            'pin_code' => $validatedData['pin_code'] ?? null,
            'image' => $storedImagePath ?? null, // Use the stored image path
            'status' => $validatedData['status'] ?? null,
            'job' => $validatedData['job'] ?? null,
            'branch_id' => $validatedData['branch_id'] ?? null,
            'must_change_password' => 1,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $branches = Branch::orderBy('branch_name', 'asc')->get();
        $titles = Title::pluck('name');
        $jobs = Job::all();
        $employee = Employee::findOrFail($id);

        return view('employees.edit', compact('branches', 'employee', 'titles', 'jobs'));
    }

    public function update(Request $request, Employee $employee)
    {
        // Log the incoming request data
        Log::info('Update method called with data: ', $request->all());

        // Ensure $employee is defined before validation (especially in update scenarios)

        $validatedData = $request->validate([
            'name'             => 'required|string|max:255',
            'branch_id'        => 'required|exists:branches,id',
            'title'            => 'required|string|max:255',
            'status'           => 'required|in:on,off',
            'date_hired'       => ['required', 'date', 'before_or_equal:today'],
            'pin_code'         => 'required|string|digits:4|unique:employee_info,pin_code,' . $employee->id . ',id',
            'email'            => 'nullable|email|unique:employee_info,email,' . $employee->id . ',id',
            'phone'            => 'nullable|string|max:15|unique:employee_info,phone,' . $employee->id . ',id',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'job'              => 'required|string|max:255',
            'blood_type'       => 'nullable|string|max:10',
            'marital_status'   => 'nullable|in:Single,Married,Divorced',
            'shift'            => 'required|in:Full Time,Part Time',
            'whish_number'     => 'nullable|string|max:255',
            'where_can_work'   => 'nullable|string|max:500', // comma-separated IDs
            'left_date'        => [
                'nullable',
                'date',
                'after_or_equal:date_hired',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->status === 'on' && !empty($value)) {
                        $fail("The {$attribute} field must be empty when the employee is active.");
                    }
                },
            ],
            'left_reason'            => 'nullable|string|max:255',
            'give_notice'            => 'nullable|boolean',
            'is_good_performer'      => 'nullable|boolean',
            'is_positive_person'     => 'nullable|boolean',
            'exit_interview_remarks' => 'nullable|string|max:500',
            'is_recommended_to_back' => 'nullable|boolean',
            'address'                => 'nullable|string|max:255',
            'car'                  => 'nullable|string|max:255',
            'birthday'             => 'nullable|date',
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
                $filename = $employee->image_path
                    ? basename($employee->image_path)
                    : uniqid() . '.' . $image->getClientOriginalExtension();
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
            'name'               => $validatedData['name'],
            'branch_id'          => $validatedData['branch_id'],
            'title'              => $validatedData['title'],
            'status'             => $validatedData['status'] === 'on',
            'date_hired'         => $validatedData['date_hired'],
            'pin_code'           => $validatedData['pin_code'],
            'email'              => $validatedData['email'] ?? null,
            'phone'              => $validatedData['phone'] ?? null,
            'image_path'         => $employee->image_path,
            'job'                => $validatedData['job'],
            'blood_type'         => $validatedData['blood_type'] ?? null,
            'marital_status'     => $validatedData['marital_status'] ?? 'Single',
            'shift'              => $validatedData['shift'] ?? 'Full Time',
            'whish_number'       => $validatedData['whish_number'] ?? null,
            'where_can_work'     => $validatedData['where_can_work'] ?? null,
            'left_date'          => $validatedData['status'] === 'on' ? null : $validatedData['left_date'],
            'left_reason'        => $validatedData['left_reason'] ?? null,
            'give_notice'        => $validatedData['give_notice'] ?? null,
            'is_good_performer'  => $validatedData['is_good_performer'] ?? null,
            'is_positive_person' => $validatedData['is_positive_person'] ?? null,
            'exit_interview_remarks' => $validatedData['exit_interview_remarks'] ?? null,
            'is_recommended_to_back' => $validatedData['is_recommended_to_back'] ?? null,
            'address'            => $validatedData['address'] ?? null,
            'car'                => $validatedData['car'] ?? null,
            'birthday'         => $validatedData['birthday'] ?? null,
        ]);

        // Update the employee record
        $employee->update([
            'name'               => $validatedData['name'],
            'branch_id'          => $validatedData['branch_id'],
            'title'              => $validatedData['title'],
            'status'             => $validatedData['status'] === 'on',
            'date_hired'         => $validatedData['date_hired'],
            'pin_code'           => $validatedData['pin_code'],
            'email'              => $validatedData['email'] ?? null,
            'phone'              => $validatedData['phone'] ?? null,
            'image_path'         => $employee->image_path,
            'job'                => $validatedData['job'],
            'blood_type'         => $validatedData['blood_type'] ?? null,
            'marital_status'     => $validatedData['marital_status'] ?? 'Single',
            'shift'              => $validatedData['shift'] ?? 'Full Time',
            'whish_number'       => $validatedData['whish_number'] ?? null,
            'where_can_work'     => $validatedData['where_can_work'] ?? null,
            'left_date'          => $validatedData['status'] === 'on' ? null : $validatedData['left_date'],
            'left_reason'        => $validatedData['left_reason'] ?? null,
            'give_notice'        => $validatedData['give_notice'] ?? null,
            'is_good_performer'  => $validatedData['is_good_performer'] ?? null,
            'is_positive_person' => $validatedData['is_positive_person'] ?? null,
            'exit_interview_remarks' => $validatedData['exit_interview_remarks'] ?? null,
            'is_recommended_to_back' => $validatedData['is_recommended_to_back'] ?? null,
            'address'            => $validatedData['address'] ?? null,
            'car'                => $validatedData['car'] ?? null,
            'birthday'         => $validatedData['birthday'] ?? null,
        ]);

        if ($employee->user) {
            $employee->user->update([
                'name'      => $validatedData['name'],
                'email'     => $validatedData['email'] ?? null,
                'image'     => $employee->image_path,
                'status'    => $validatedData['status'] === 'on' ? 'active' : 'inactive',
                'job'       => $validatedData['job'],
                'pin_code'  => $validatedData['pin_code'],
                'branch_id' => $validatedData['branch_id'],
            ]);
        }
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
                $notification = Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_alert',
                    'message' => "{$creator->name} has deleted the employee named {$employee->name}, who was working as {$job} at {$branchName}.",
                    'notified_at' => now(),
                    'is_read' => false,
                    'user_image' => $creator->image ?? '/images/Default.jpg',
                ]);
            }
        }

        broadcast(new NewNotification($notification))->toOthers();

        if ($employee->image_path && Storage::disk('public')->exists($employee->image_path)) {
            Storage::disk('public')->delete($employee->image_path);
            Log::info('Image deleted successfully:', ['image_path' => $employee->image_path]);
        }

        // Delete the user associated with the employee
        if ($employee->user) {
            $employee->user->delete(); // Delete the related user
            Log::info('User deleted successfully:', ['user_id' => $employee->user->id]);
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
        Log::info('Upload request received', ['request' => $request->all()]);

        $employeeName = $request->input('employeeName');
        $pinCode = $request->input('pinCode');
        $folderName = "$employeeName-$pinCode";
        $folderPath = "employees-data/$folderName";

        if (!$request->hasFile('files')) {
            Log::error('No files provided in request');
            return response()->json(['message' => 'No files provided'], 400);
        }

        $files = $request->file('files');

        foreach ($files as $file) {
            Log::info('Processing file', ['file_name' => $file->getClientOriginalName(), 'size' => $file->getSize()]);

            try {
                Storage::disk('public')->putFileAs($folderPath, $file, $file->getClientOriginalName());
                Log::info('File uploaded successfully', ['file_name' => $file->getClientOriginalName()]);
            } catch (\Exception $e) {
                Log::error('Failed to upload file', ['error' => $e->getMessage()]);
                return response()->json(['message' => 'Failed to upload file'], 500);
            }
        }

        Log::info('All files uploaded successfully');
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

            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'File not found.'
        ], 404);
    }

    public function countEmp(Request $request)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = Employee::query();

        // Search Filter
        if ($request->has('search') && !empty($request->search)) {
            $searchTerms = explode(' ', trim($request->search));
            $query->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->where('name', 'LIKE', "%{$term}%")
                        ->orWhere('title', 'LIKE', "%{$term}%")
                        ->orWhereHas('jobRelation', function ($jQuery) use ($term) {
                            // ✅ Fix job relation for search
                            $jQuery->where('name', 'LIKE', "%{$term}%");
                        })
                        ->orWhereHas('branch', function ($bQuery) use ($term) {
                            $bQuery->where('branch_name', 'LIKE', "%{$term}%");
                        });
                }
            });
        }

        // Branch Filter
        if ($request->has('branch') && !empty($request->branch)) {
            $query->where('branch_id', $request->branch);
        }

        // Job Filter
        if ($request->has('job') && !empty($request->job)) {
            $query->whereHas('jobRelation', function ($jQuery) use ($request) {
                // ✅ Fix job relation filter
                $jQuery->where('id', $request->job);
            });
        }

        // Total Employees Count
        $totalEmployees = $query->count();

        // New Joiners in the Last 6 Months
        $newJoinersCount = $query->where('date_hired', '>=', $sixMonthsAgo)->count();

        return response()->json([
            'total_employees' => $totalEmployees,
            'new_joiners' => $newJoinersCount,
        ]);
    }
    public function exportEmployees(Request $request)
    {
        // Extract filter parameters from request
        $filters = [
            'search' => $request->input('search'),
            'branch' => $request->input('branch'),
            'job' => $request->input('job'),
            'date_hired_from' => $request->input('date_hired_from'),
            'date_hired_to' => $request->input('date_hired_to'),
        ];

        // Log the filters to check if they are being received
        Log::info('Exporting Employees with filters:', $filters);

        return Excel::download(new EmployeesExport($filters), 'filtered_employees.xlsx');
    }
    public function checkProbationPeriod()
    {
        $employees = DB::table('employee_info')->where('status', 1)->get();
        $today = Carbon::now();
        $probationPeriodStart = 90;
        $probationPeriodEnd = 120;

        Log::info("Running probation check for today: " . $today->toDateString());

        foreach ($employees as $employee) {
            // ✅ Fix Date Parsing
            $hiredDate = Carbon::createFromFormat('Y-m-d', $employee->date_hired)->startOfDay();
            $daysPassed = floor($hiredDate->diffInDays($today));

            Log::info("Checking employee: {$employee->name}, Hired: {$hiredDate->toDateString()}, Days Passed: $daysPassed");
            Log::info("Stored Image Path in DB: " . $employee->image_path);

            // ✅ Use the stored image path or default
            $userImage = !empty($employee->image_path) ? $employee->image_path : 'images/default.jpg';

            Log::info("Final Employee Image Used: " . $userImage);

            // ✅ Notify Only Employees Between 90 - 120 Days
            if ($daysPassed >= $probationPeriodStart && $daysPassed <= $probationPeriodEnd) {
                // ✅ Check if notification already exists for this employee
                $alreadyNotified = DB::table('notifications')
                    ->where('type', 'probation_alert')
                    ->where('message', 'LIKE', "%{$employee->name}%")
                    ->exists();

                if (!$alreadyNotified) {
                    $hrUsers = \App\Models\User::role(['Hr Team Member', 'Admin'])->get();
                    Log::info("Employee {$employee->name} is in probation range. Sending notifications...");

                    foreach ($hrUsers as $user) {
                        try {
                            $notification = Notification::create([
                                'user_id' => $user->id,
                                'type' => 'probation_alert',
                                'message' => "Probation period for {$employee->name} is ending soon (Day $daysPassed).",
                                'notified_at' => now(),
                                'is_read' => false,
                                'user_image' => $userImage, // ✅ Correctly stored image path
                            ]);

                            Log::info("Notification sent to: {$user->name}");
                        } catch (\Exception $e) {
                            Log::error("Failed to send notification", ['error' => $e->getMessage()]);
                        }
                    }

                    broadcast(new NewNotification($notification))->toOthers();
                } else {
                    Log::info("✅ Skipping {$employee->name} (Already Notified)");
                }
            } else {
                Log::info("Employee {$employee->name} is NOT in probation range ($daysPassed days). No notification sent.");
            }
        }

        return response()->json(['message' => 'Probation period check completed.']);
    }
}
