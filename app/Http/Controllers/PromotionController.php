<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = DB::table('table_promotions')
            ->join('employee_info', 'table_promotions.employee_id', '=', 'employee_info.id')
            ->select('employee_info.image_path', 'employee_info.name as employee_name', 'table_promotions.old_title', 'table_promotions.new_title', 'table_promotions.promotion_date', 'table_promotions.id', 'table_promotions.employee_id')
            ->orderBy('table_promotions.promotion_date', 'desc')
            ->take(30) // Load 30 items initially
            ->get();

        $promotionsByYear = DB::table('table_promotions')->select(DB::raw('YEAR(promotion_date) as year'), DB::raw('COUNT(*) as count'))->groupBy('year')->orderBy('year', 'desc')->get();

        return view('promotions.index', compact('promotions', 'promotionsByYear'));
    }

    public function create()
    {
        $employees = DB::table('employee_info')->join('branches', 'employee_info.branch_id', '=', 'branches.id')->select('employee_info.id', 'employee_info.name', 'employee_info.title', 'employee_info.pin_code', 'employee_info.branch_id', 'branches.branch_name as branch_name')->orderBy('employee_info.name', 'asc')->get();

        $titles = DB::table('titles')->select('name', 'rank')->distinct()->orderBy('rank', 'asc')->get();

        return view('promotions.create', compact('employees', 'titles'));
    }

    public function store(Request $request)
    {
        Log::info('Incoming request:', $request->all());
    
        // Validate input
        $request->validate([
            'employee_id' => 'required',
            'old_title' => 'required',
            'new_title' => 'required',
            'promotion_date' => 'required|date',
        ]);
        Log::info('Validation passed.');
    
        // Fetch ranks
        $oldRank = DB::table('titles')->where('name', $request->old_title)->value('rank');
        $newRank = DB::table('titles')->where('name', $request->new_title)->value('rank');
        Log::info("Rank check: Old rank = $oldRank, New rank = $newRank");
    
        // Check for rank issue
        if ($newRank >= $oldRank) {
            Log::warning('Rank check failed: New title rank is not better.');
    
            if (!$request->has('confirmed')) {
                Log::info('Confirmation not provided. Returning error.');
                return response()->json([
                    'error' => true,
                    'message' => 'The new title rank is not better than the old title. Are you sure you want to proceed?',
                ]);
            }
    
            Log::info('Confirmation received. Proceeding with saving.');
        }
    
        // Save the promotion
        $promotion = Promotion::create($request->all());
        Log::info('Promotion saved:', ['promotion_id' => $promotion->id]);
    
        // Update employee title
        DB::table('employee_info')
            ->where('id', $request->employee_id)
            ->update(['title' => $request->new_title]);
        Log::info('Employee title updated:', ['employee_id' => $request->employee_id]);
    
        // Get the creator's name
        $creator = Auth::user();
    
        // Get the branch and job details for the notification
        $employee = Employee::findOrFail($request->employee_id);
        $new_title = $promotion->new_title ?? 'N/A';
        $employeeName = $employee->name ?? 'N/A';
    
        // Notify all admins about the new promotion except the creator
        $adminUsers = User::role('Admin')->get();
        foreach ($adminUsers as $admin) {
            if ($admin->id !== $creator->id) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_alert',
                    'message' => "{$creator->name} has created a new promotion for {$employeeName} to the position of {$new_title}.",
                    'notified_at' => now(),
                    'is_read' => false,
                    'user_image' => $creator->image ?? '/images/Default.jpg',
                ]);
            }
        }
    
        return response()->json([
            'success' => true,
            'redirect' => route('promotions.index'),
            'message' => 'Promotion created successfully.',
        ]);
    }
    

    public function destroy(Request $request, $id)
    {
        Log::info('HTTP Method:', ['method' => $request->method()]);
        Log::info('Destroy Request Data:', $request->all());
    
        if ($request->method() !== 'DELETE') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid HTTP method. Expected DELETE but received ' . $request->method(),
                ],
                405,
            );
        }
    
        if (!is_numeric($request->employee_id)) {
            Log::error('Delete Promotion Error: Employee ID is not a number.');
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid employee ID received. It must be an integer.',
                ],
                400,
            );
        }
    
        // Validate request
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employee_info,id',
            'old_title' => 'required|string',
        ]);
    
        // Find and delete the promotion
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();
    
        // Update employee title
        $updated = DB::table('employee_info')
            ->where('id', $validatedData['employee_id'])
            ->update(['title' => $validatedData['old_title']]);
    
        // Get the creator's name
        $creator = Auth::user();
    
        // Get the job and branch details for the notification
        $employee = Employee::findOrFail($validatedData['employee_id']);
        $new_title = $promotion->new_title;
    
        // ✅ Fetch users with 'Admin' role via Spatie instead of using `role_name` column
        $adminUsers = User::role('Admin')->get();
    
        foreach ($adminUsers as $admin) {
            if ($admin->id !== $creator->id) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_alert',
                    'message' => "{$creator->name} has deleted the promotion for {$employee->name} for the title of {$new_title}.",
                    'notified_at' => now(),
                    'is_read' => false,
                    'user_image' => $creator->image ?? '/images/Default.jpg',
                ]);
            }
        }
    
        return response()->json([
            'success' => $updated ? true : false,
            'message' => $updated ? 'Promotion deleted and title reset.' : 'Failed to reset title.',
        ]);
    }

    public function getAllPromo(Request $request)
    {
        $query = $request->get('query', '');

        $promotions = DB::table('table_promotions')
            ->join('employee_info', 'table_promotions.employee_id', '=', 'employee_info.id')
            ->select(
                'employee_info.id as employee_id', // Include employee_id
                'employee_info.image_path',
                'employee_info.name as employee_name',
                'table_promotions.old_title',
                'table_promotions.new_title',
                'table_promotions.promotion_date',
                'table_promotions.id'
            )
            ->where(function ($q) use ($query) {
                if (!empty($query)) {
                    $q->where('employee_info.name', 'like', '%' . $query . '%')
                      ->orWhere('table_promotions.new_title', 'like', '%' . $query . '%');
                }
            })
            ->orderBy('table_promotions.promotion_date', 'desc') 
            ->get(); 
    
        return response()->json($promotions);
    }

    public function getPromotionStats()
    {
        $stats = DB::table('table_promotions')->select('new_title', DB::raw('COUNT(*) as total'))->groupBy('new_title')->orderBy('total', 'desc')->take(3)->get();

        return response()->json($stats);
    }

    public function downloadPromotionLetter($id)
    {
        $promotion = DB::table('table_promotions')
            ->join('employee_info', 'table_promotions.employee_id', '=', 'employee_info.id')
            ->join('branches', 'employee_info.branch_id', '=', 'branches.id') // ✅ JOIN to get location name
            ->select(
                'employee_info.name as employee_name',
                'branches.branch_name as employee_branch', // ✅ Get branch name instead of ID
                'table_promotions.new_title',
            )
            ->where('table_promotions.id', $id)
            ->first();

        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found'], 404);
        }

        $pdf = Pdf::loadView('pdf.promotion_letter', compact('promotion'));
        return $pdf->download("promotion_letter_{$promotion->employee_name}.pdf");
    }
}
