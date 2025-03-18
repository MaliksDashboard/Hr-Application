<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Branch;
use App\Models\Vacancy;
use App\Models\Employee;
use App\Models\Transfer;
use App\Mail\TransferEmail;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransferController extends Controller
{
    public function index()
    {
        $totalTransfers = Transfer::count();

        $mostActiveBranches = Transfer::select('old_branch_id', 'new_branch_id', DB::raw('COUNT(*) as total'))->groupBy('old_branch_id', 'new_branch_id')->orderBy('total', 'desc')->get();

        $mostTransferredRoles = Transfer::with('employee') // No need for jobRelation
            ->whereNotNull('employee_id')
            ->whereHas('employee') // Ensure employee exists in employee_info
            ->select('employee_id', DB::raw('COUNT(*) as total'))
            ->groupBy('employee_id')
            ->orderBy('total', 'desc')
            ->take(3)
            ->get();

        $mostEffectedBranch = Transfer::select('old_branch_id', DB::raw('COUNT(*) as total'))->with('oldBranch')->groupBy('old_branch_id')->orderBy('total', 'desc')->first();

        // Handle null case for mostEffectedBranch
        $mostEffectedBranchData = $mostEffectedBranch
            ? [
                'branch_name' => $mostEffectedBranch->oldBranch->branch_name ?? 'N/A',
                'total' => $mostEffectedBranch->total ?? 0,
            ]
            : ['branch_name' => 'N/A', 'total' => 0];

        $transfers = Transfer::with(['employee', 'oldBranch', 'newBranch', 'vacancy', 'creator', 'jobRelation'])
            ->leftJoin('users', 'transfers.created_by', '=', 'users.id')
            ->select('transfers.*', 'users.name as created_by_name')
            ->latest()
            ->paginate(10);

        return view(
            'transfers.index',
            compact(
                'totalTransfers',
                'mostActiveBranches',
                'mostTransferredRoles',
                'transfers',
                'mostEffectedBranchData', // Updated variable passed to view
            ),
        );
    }

    public function create(Request $request)
    {
        $employees = Employee::where('status', 1)->get(); // Fetch employees with status = 1
        $branches = Branch::all();
        $jobs = Job::all();
        $branchId = $request->branch_id;
        $vacancies = Vacancy::with('jobRelation')->where('branch_id', $branchId)->get();

        return view('transfers.create', compact('employees', 'branches', 'vacancies', 'jobs'));
    }

    public function applyTransfer(Request $request)
    {
        // Convert the date format
        if ($request->has('transfer_start_date')) {
            $request->merge([
                'transfer_start_date' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('transfer_start_date'))->format('Y-m-d'),
            ]);
        }

        // Validate input
        $validated = $request->validate([
            'employee_id' => 'required|exists:employee_info,id',
            'branch_id' => 'required|exists:branches,id',
            'vacancy_id' => 'nullable|string',
            'old_branch_id' => 'required|exists:branches,id',
            'transfer_start_date' => 'required|date_format:Y-m-d',
            'prompt_new_vacancy' => 'nullable|in:yes,no',
            'type' => 'nullable|string|max:50',
            'rotation_duration' => 'nullable|date_format:Y-m-d',
        ]);

        $validated['vacancy_id'] = $validated['vacancy_id'] ?? null;

        if (!Auth::check()) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        $employee = Employee::findOrFail($validated['employee_id']);
        $oldBranchId = $employee->branch_id;

        session()->put('latest_transfer', [
            'employee_id' => $employee->id,
            'employee_name' => $employee->name,
            'old_branch_id' => $oldBranchId, // Store old branch BEFORE updating
            'new_branch_id' => $validated['branch_id'], // Selected branch from form
            'start_date' => $validated['transfer_start_date'],
        ]);

        Log::info("Starting transfer for employee {$employee->id} from branch {$oldBranchId} to branch {$validated['branch_id']}");

        try {
            DB::beginTransaction();

            // Transfer logic
            if ($validated['branch_id'] !== $oldBranchId) {
                Log::info('Updating employee branch.');
                $employee->update(['branch_id' => $validated['branch_id']]);

                // Handle vacancy only if `vacancy_id` is valid and not "none"
                if (!empty($validated['vacancy_id']) && $validated['vacancy_id'] !== 'none') {
                    Log::info('Updating vacancy with employee information.');
                    Vacancy::where('id', $validated['vacancy_id'])->update([
                        'is_finished' => true,
                        'completed_date' => now(),
                        'employee_id' => $employee->id,
                        'image_path' => $employee->image_path,
                    ]);
                } else {
                    Log::info("No vacancy update needed as 'none' is selected.");
                }
            }

            // Create a new vacancy for the old branch if requested
            if ($request->input('prompt_new_vacancy') === 'yes') {
                Log::info("Creating vacancy for branch {$oldBranchId} with job {$employee->job}.");
                Vacancy::create([
                    'branch_id' => $oldBranchId,
                    'job' => $employee->job,
                    'status' => 'high',
                    'asked_date' => now(),
                ]);
            }

            Log::info('User ID trying to create transfer:', ['user_id' => Auth::id()]);

            // Insert into transfers table
            Log::info('Inserting transfer data:', [
                'employee_id' => $employee->id,
                'old_branch_id' => $oldBranchId,
                'new_branch_id' => $validated['branch_id'],
                'vacancy_id' => $validated['vacancy_id'] !== 'none' ? $validated['vacancy_id'] : null,
                'transfer_date' => now(),
                'transfer_start_date' => $validated['transfer_start_date'],
                'created_by' => Auth::id(),
                'type' => $validated['type'] ?? 'Transfer',
            ]);

            Transfer::create([
                'employee_id' => $employee->id,
                'old_branch_id' => $oldBranchId,
                'new_branch_id' => $validated['branch_id'],
                'vacancy_id' => $validated['vacancy_id'] !== 'none' ? $validated['vacancy_id'] : null,
                'transfer_date' => now(),
                'transfer_start_date' => $validated['transfer_start_date'],
                'created_by' => Auth::id() ?? 2,
                'type' => $validated['type'] ?? 'Transfer',
                'rotation_duration' => $validated['type'] === 'Rotation' ? $request->input('rotation_duration') : null,
            ]);

            Log::info('Transfer inserted successfully.');

            // Notification Logic
            if ($validated['type'] === 'Rotation') {
                Log::info('Rotation detected. Calculating reminder date.');
                // Calculate reminder date (3 days before rotation end)
                $rotationEndDate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->rotation_duration);
                $reminderDate = $rotationEndDate->subDays(3);
                Log::info("Reminder date set for: {$reminderDate->format('d-m-Y')}");

                // Create a notification for the user who created this rotation
                $imagePath = $employee->image_path ?? '/images/Default.jpg';
                Log::info("User image path: {$imagePath}");

                // Creating notification for the user who created this rotation
                $notification = Notification::create([
                    'user_id' => Auth::id(),
                    'type' => 'rotation_reminder',
                    'message' => "Reminder: The rotation for {$employee->name} at {$employee->branch->branch_name} will end on {$rotationEndDate->format('d-m-Y')}.",
                    'notified_at' => $reminderDate,
                    'is_read' => false,
                    'user_image' => $imagePath,
                ]);

                broadcast(new NewNotification($notification))->toOthers();

                Log::info('Rotation reminder notification created for the user.');

                // Notify admins about the rotation, excluding the current logged-in admin
                $adminUsers = User::role('Admin')->get();
                foreach ($adminUsers as $admin) {
                    // Skip sending notification to the logged-in admin
                    if ($admin->id == Auth::id()) {
                        continue; // Skip the current admin
                    }

                    Log::info("Creating admin notification for {$admin->name}");
                    $notification = Notification::create([
                        'user_id' => $admin->id,
                        'type' => 'admin_alert',
                        'message' => " {$employee->name} is scheduled to complete rotation on {$rotationEndDate->format('d-m-Y')}.",
                        'notified_at' => $reminderDate,
                        'is_read' => false,
                        'user_image' => $admin->$imagePath,
                    ]);
                }

                broadcast(new NewNotification($notification))->toOthers();

                Log::info('Admin notifications created successfully.');
            }

            // Get the action type (Rotation or Transfer)
            $actionType = $validated['type']; // Either 'Rotation' or 'Transfer'

            // Get the current logged-in user ID
            $currentUserId = Auth::id();

            // Create a notification for admins based on the action type
            $adminUsers = User::role('Admin')->get();

            foreach ($adminUsers as $admin) {
                // Skip the current admin if they are the one who created the action
                if ($admin->id == $currentUserId) {
                    continue; // Skip notification for the logged-in user
                }

                Log::info("Creating admin notification for {$actionType} action for {$admin->name}");

                // If it's a Rotation
                if ($actionType === 'Rotation') {
                    $notification = Notification::create([
                        'user_id' => $admin->id,
                        'type' => 'admin_alert',
                        'message' => Auth::user()->name . " has created a rotation for {$employee->name} to branch {$employee->branch->branch_name}",
                        'notified_at' => now(),
                        'is_read' => false,
                        'user_image' => Auth::user()->image,
                    ]);
                }
                // If it's a Transfer
                elseif ($actionType === 'Transfer') {
                    $notification = Notification::create([
                        'user_id' => $admin->id,
                        'type' => 'admin_alert',
                        'message' => Auth::user()->name . " has created a transfer for {$employee->name} to branch {$employee->branch->branch_name}",
                        'notified_at' => now(),
                        'is_read' => false,
                        'user_image' => Auth::user()->image,
                    ]);
                }
            }

            broadcast(new NewNotification($notification))->toOthers();

            Log::info('Admin transfer action notifications created successfully.');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transfer applied successfully!',
                'showEmailPrompt' => true, // Flag to trigger the email prompt on the frontend
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transfer failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to apply transfer. Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function cancelTransfer($id)
    {
        try {
            DB::beginTransaction();

            $transfer = Transfer::findOrFail($id);

            // Get associated employee and branches
            $employee = $transfer->employee;
            $oldBranchId = $transfer->old_branch_id;
            $newBranchId = $transfer->new_branch_id;

            // Roll back the employee's branch
            $employee->update([
                'branch_id' => $oldBranchId,
            ]);

            // Handle vacancies
            // Delete the vacancy created for the old branch
            $vacancyToDelete = Vacancy::where('branch_id', $oldBranchId)->where('job', $employee->job)->where('is_finished', false)->latest()->first();

            if ($vacancyToDelete) {
                $vacancyToDelete->delete();
            }

            // Reopen the vacancy in the new branch
            $vacancyToReopen = Vacancy::where('branch_id', $newBranchId)->where('job', $employee->job)->where('is_finished', true)->latest()->first();

            if ($vacancyToReopen) {
                $vacancyToReopen->update([
                    'is_finished' => false,
                    'employee_id' => null,
                    'completed_date' => null,
                ]);
            }

            // Delete the transfer record
            $transfer->delete();

            // Delete the notifications related to the canceled transfer for the employee and admins
            Notification::whereIn('type', ['rotation_reminder', 'admin_alert', 'transfer']) // Including 'transfer' notifications as well
                ->where('is_read', false) // Only delete unread notifications
                ->where(function ($query) use ($employee) {
                    // Check if the message contains the employee's name and branch name (to target relevant notifications)
                    $query->where('message', 'like', "%{$employee->name}%")->orWhere('message', 'like', "%{$employee->branch->branch_name}%");
                })
                ->delete();

            // Optionally, also delete notifications created by the current logged-in user (for admins or the creator)
            Notification::where('user_id', Auth::id()) // This will delete notifications created by the current logged-in user
                ->whereIn('type', ['rotation_reminder', 'admin_alert', 'transfer']) // Including 'transfer' notifications
                ->where('is_read', false) // Only delete unread notifications
                ->where(function ($query) use ($employee) {
                    // Check if the message contains the employee's name and branch name
                    $query->where('message', 'like', "%{$employee->name}%")->orWhere('message', 'like', "%{$employee->branch->branch_name}%");
                })
                ->delete();

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Transfer canceled successfully and notifications deleted.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error canceling transfer: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Failed to cancel transfer and delete notifications.'], 500);
        }
    }

    public function generatePDF($id)
    {
        try {
            $transfer = Transfer::with(['employee', 'oldBranch', 'newBranch'])->findOrFail($id);

            // Format dates for consistency
            $startDate = \Carbon\Carbon::parse($transfer->transfer_start_date)->format('d-m-Y');
            $transferDate = \Carbon\Carbon::parse($transfer->transfer_date)->format('d-m-Y');

            // Get employee name (sanitize it to avoid filename issues)
            $employeeName = str_replace([' ', '/'], '_', $transfer->employee->name);

            if ($transfer->type === 'Rotation') {
                // Handle Rotation Letter
                $rotationEndDate = \Carbon\Carbon::parse($transfer->rotation_duration)->format('d-m-Y');

                $data = [
                    'employeeName' => $transfer->employee->name,
                    'job' => $transfer->employee->job,
                    'oldBranch' => $transfer->oldBranch->branch_name ?? 'N/A',
                    'newBranch' => $transfer->newBranch->branch_name ?? 'N/A',
                    'startDate' => $startDate,
                    'rotationEndDate' => $rotationEndDate,
                ];

                $pdf = Pdf::loadView('transfers.rotation_letter', $data);
                return $pdf->download("{$employeeName} - Rotation.pdf");
            } else {
                // Handle Transfer Letter
                $data = [
                    'employeeName' => $transfer->employee->name,
                    'job' => $transfer->employee->job,
                    'oldBranch' => $transfer->oldBranch->branch_name ?? 'N/A',
                    'newBranch' => $transfer->newBranch->branch_name ?? 'N/A',
                    'transferDate' => $transferDate,
                    'startDate' => $startDate,
                ];

                $pdf = Pdf::loadView('transfers.pdf', $data);
                return $pdf->download("{$employeeName} - Transfer.pdf");
            }
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to generate document.');
        }
    }

    public function changeActionType($id)
    {
        try {
            $transfer = Transfer::findOrFail($id);

            // Ensure the current type is Rotation before updating
            if ($transfer->type !== 'Rotation') {
                return response()->json(['success' => false, 'message' => 'Action type is not a Rotation, cannot change to Transfer.']);
            }

            // Get the employee associated with this transfer
            $employee = $transfer->employee;

            // Get the original creator of the rotation
            $creator = User::find($transfer->created_by); // This assumes 'created_by' stores the creator's user ID

            // Update the action type to 'Transfer'
            $transfer->update(['type' => 'Transfer']);

            // 1. Notify all admins except the creator
            $adminUsers = User::role('Admin')->get();
            foreach ($adminUsers as $admin) {
                // Skip the creator to avoid sending a notification to them
                if ($admin->id !== $creator->id) {
                    $notification = Notification::create([
                        'user_id' => $admin->id,
                        'type' => 'admin_alert',
                        'message' => Auth::user()->name . " has marked the rotation of {$employee->name} as a transfer.",
                        'notified_at' => now(),
                        'is_read' => false,
                        'user_image' => $admin->image ?? '/images/Default.jpg',
                    ]);
                }
            }

            broadcast(new NewNotification($notification))->toOthers();

            // 2. Notify the creator of the rotation about the change to Transfer
            $notification = Notification::create([
                'user_id' => $creator->id,
                'type' => 'admin_alert',
                'message' => "The rotation of {$employee->name} as a transfer by the Admin.",
                'notified_at' => now(),
                'is_read' => false,
                'user_image' => $creator->image ?? '/images/Default.jpg',
            ]);

            broadcast(new NewNotification($notification))->toOthers();

            return response()->json(['success' => true, 'message' => 'The action type has been successfully changed to Transfer.']);
        } catch (\Exception $e) {
            Log::error('Error changing action type: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to change action type. Please try again.']);
        }
    }

    public function sendTransferEmail(Request $request)
    {
        Log::info('Sending transfer email request received', ['request' => $request->all()]);

        // Get transfer details from session
        $transferData = session('latest_transfer');

        if (!$transferData) {
            Log::error('No transfer data found in session.');
            return response()->json(['success' => false, 'message' => 'No transfer data available.']);
        }

        $employeeId = $transferData['employee_id'];
        $oldBranchId = $transferData['old_branch_id'];
        $newBranchId = $transferData['new_branch_id'];
        $employeeName = $transferData['employee_name'];
        $startDate = $transferData['start_date'];
        $transferType = $request->input('type'); // Get type from form

        Log::info('Old Branch ID:', ['oldBranchId' => $oldBranchId]);
        Log::info('New Branch ID:', ['newBranchId' => $newBranchId]);

        // Fetch branches
        $oldBranch = Branch::find($oldBranchId);
        $newBranch = Branch::find($newBranchId);

        if (!$oldBranch || !$newBranch) {
            return response()->json(['success' => false, 'message' => 'Branch data missing.']);
        }

        Log::info('Old Branch Manager Email:', ['oldBranchManagerEmail' => $oldBranch->manager_email]);
        Log::info('New Branch Manager Email:', ['newBranchManagerEmail' => $newBranch->manager_email]);

        // Ensure emails exist
        if (!$oldBranch->manager_email || !$newBranch->manager_email) {
            return response()->json(['success' => false, 'message' => 'Manager email missing.']);
        }

        // ✅ Generate the PDF file and store it temporarily
        $pdfPath = storage_path("app/public/{$employeeName}_{$transferType}.pdf");

        try {
            $data = [
                'employeeName' => $employeeName,
                'job' => Employee::find($employeeId)->job ?? 'N/A',
                'oldBranch' => $oldBranch->branch_name ?? 'N/A',
                'newBranch' => $newBranch->branch_name ?? 'N/A',
                'startDate' => \Carbon\Carbon::parse($startDate)->format('d-m-Y'),
            ];

            if ($transferType === 'Rotation') {
                // ✅ Fix: Ensure rotation end date is passed
                $rotationEndDate = $request->input('rotation_duration');

                if ($rotationEndDate) {
                    $data['rotationEndDate'] = \Carbon\Carbon::parse($rotationEndDate)->format('d-m-Y');
                } else {
                    $data['rotationEndDate'] = 'N/A'; // Default in case rotation_end_date is missing
                }

                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transfers.rotation_letter', $data);
            } else {
                $data['transferDate'] = \Carbon\Carbon::now()->format('d-m-Y');
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transfers.pdf', $data);
            }

            // Save PDF file in storage
            $pdf->save($pdfPath);
            Log::info("PDF Generated: {$pdfPath}");
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to generate PDF.']);
        }

        // ✅ Send the email with the attached PDF
        try {
            Mail::to([$newBranch->manager_email, $oldBranch->manager_email])->send(
                new TransferEmail(
                    $request->input('cc'),
                    $employeeName,
                    $startDate,
                    Auth::user()->email,
                    $transferType,
                    $pdfPath, // Attach generated PDF
                ),
            );

            Log::info('Transfer email sent successfully.');

            // ✅ Delete the PDF after sending (optional)
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
                Log::info("PDF deleted: {$pdfPath}");
            }

            return response()->json(['success' => true, 'message' => 'Email sent successfully with attachment!']);
        } catch (\Exception $e) {
            Log::error('Error sending email', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error sending email: ' . $e->getMessage()]);
        }
    }
}
