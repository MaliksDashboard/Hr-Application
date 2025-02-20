<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Broadcast;
use App\Models\Notification;
use Illuminate\Http\Request;

Route::middleware('auth')->group(function () {
    //route for the Main Page
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:Dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Users Routes
    Route::get('/users/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::resource('users', UserController::class)->middleware('permission:Users');
    Route::get('/getusers', [UserController::class, 'getUsersByRole']);
    Route::post('/lock-rule', [UserController::class, 'lockRule'])->name('lock.rule');
    Route::get('/check-temp-pass', [UserController::class, 'checkTempPass'])->name('check.temp.pass');
    Route::get('/lock-screen', [UserController::class, 'lockScreen'])->name('users.lock');
    Route::post('/unlock-screen', [UserController::class, 'unlockScreen'])->name('users.unlock');

    //Employees Routes
    Route::delete('/delete-file', [EmployeesController::class, 'delete'])->name('delete.file');
    Route::delete('/employees/bulk-delete', [EmployeesController::class, 'bulkDelete'])->name('employees.bulkDelete');
    Route::resource('employees', EmployeesController::class)->middleware('permission:Employees');
    Route::get('/get-employees-info', [EmployeesController::class, 'getEmployeeInfo']);
    Route::get('/employee-files/{employeeName}/{pinCode}', [EmployeesController::class, 'getEmployeeFiles']);
    Route::get('/employee-files/{employeeName}/{pinCode}/download-all', [EmployeesController::class, 'downloadAllFiles']);
    Route::post('/upload-employee-files', [EmployeesController::class, 'uploadFiles'])->name('employee.uploadFiles');
    Route::get('/export-employees', function () {
        return Excel::download(new EmployeesExport(), 'employees.xlsx');
    })->name('employees.export');

    //Branches Routes
    Route::resource('/branches', BranchController::class)->middleware('permission:Branches');
    Route::get('/branches-data', [BranchController::class, 'getBranchesData'])->name('branches.data');
    Route::get('/branches-manager', [BranchController::class, 'getBranchesManager']);
    Route::get('/branches/{branch}/employees', [BranchController::class, 'fetchBranchEmployees'])->name('branches.employees');

    //Calendars Page
    Route::get('/events', [CalendarController::class, 'fetchEvents']);
    Route::post('/events', [CalendarController::class, 'storeEvent']);
    Route::get('/calendar', function () {
        return view('calendar');
    })->middleware('permission:Calendar & Tools');
    Route::post('/events', [CalendarController::class, 'storeEvent']);
    Route::get('/upcoming-events', [CalendarController::class, 'fetchUpcomingEvents']);
    Route::delete('/events/{id}', [CalendarController::class, 'deleteEvent']);
    Route::put('/events/{id}', [CalendarController::class, 'editEvent']);
    Route::get('/events/{id}', [CalendarController::class, 'fetchEvent']);

    //Titles routes
    Route::resource('titles', TitleController::class)->middleware('permission:Titles');
    Route::post('/titles/update-ranks', [TitleController::class, 'updateRanks'])->name('titles.updateRanks');
    Route::get('/titles/{id}', [TitleController::class, 'show']);
    Route::delete('/titles/{id}', [TitleController::class, 'destroy'])->name('titles.destroy');
    Route::get('/get-titles-data', [TitleController::class, 'getTitleData']);

    //Vacancies routes
    Route::get('/vacancies/fetch', [VacancyController::class, 'fetch'])->name('vacancies.fetch');
    Route::resource('vacancies', VacancyController::class)->middleware('permission:Vacancies');

    //Transfers routes
    Route::post('/send-transfer-email', [TransferController::class, 'sendTransferEmail'])->name('sendTransferEmail');
    Route::resource('transfers', TransferController::class)->middleware('permission:Trasnfers/Rotation');
    Route::post('/transfers/apply', [TransferController::class, 'applyTransfer'])->name('transfers.apply');
    Route::post('/transfers/{id}/cancel', [TransferController::class, 'cancelTransfer'])->name('transfers.cancel');
    Route::get('/transfers/{id}/pdf', [TransferController::class, 'generatePDF'])->name('transfers.pdf');
    Route::post('/transfers/{id}/change-action-type', [TransferController::class, 'changeActionType'])->name('transfers.changeActionType');

    // //Chat Controller
    // Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

    // // Fetch messages
    // Route::get('/chat/messages', [ChatController::class, 'fetchMessages'])->name('chat.fetch');

    // // Send a message
    // Route::post('/chat/messages', [ChatController::class, 'sendMessage'])->name('chat.messages');
    // // Define the broadcast channel
    // Broadcast::channel('chat.{userId}', function ($user, $userId) {
    //     return (int) $user->id === (int) $userId;
    // });

    //Promotions routes
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy');
    Route::resource('promotions', PromotionController::class)->middleware('permission:Promotions');
    Route::get('/getAllPromo',[PromotionController::class,'getAllPromo']);
    Route::get('/promotion-stats', [PromotionController::class, 'getPromotionStats']);
    Route::get('/promotions/{id}/download', [PromotionController::class, 'downloadPromotionLetter'])->name('promotions.download');

    //Barcode Routes
    Route::get('/badge', [BadgeController::class, 'index'])->name('badge.index')->middleware('permission:Badge Maker');
    Route::post('/badge/generate', [BadgeController::class, 'generateBadge'])->name('badge.generate')->middleware('permission:Badge Maker');
    Route::get('/getEmployeesByBranch/{branchId}', [BadgeController::class, 'getEmployeesByBranch'])->middleware('permission:Badge Maker');

    //New Joiners System Routes
    Route::get('/employee-progress/{id}', [NewJoinerController::class, 'getEmployeeProgress']);
    Route::get('/new-joiners-data', [NewJoinerController::class, 'getNewJoinersData']);
    Route::resource('new-joiners', NewJoinerController::class)->middleware('permission:New Joiners');
    Route::post('/save-phase-progress', [NewJoinerController::class, 'savePhaseProgress']);

    //Notification System
    Route::get('/notifications', [NotificationController::class, 'fetchNotifications']);
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    //Roles And Permissions API:
    Route::get('add-permission', [RolesAndPermissionController::class, 'addPermissions']);
    Route::resource('roles', RolesAndPermissionController::class)->middleware('permission:Role And Permission');
    Route::get('/getroles', [RolesAndPermissionController::class, 'getRoles']);
    Route::put('/roles/{id}', [RolesAndPermissionController::class, 'update'])->name('roles.update');

});

//Route for getting the user role
Route::get('/api/get-user-role', function () {
    $user = Auth::user(); // Use the Auth facade
    if ($user) {
        return response()->json(['role_name' => $user->role_name]);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
})->middleware('auth');

//Routes for falling back if the page was not found
Route::fallback(function () {
    return redirect('/dashboard');
});

//Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
