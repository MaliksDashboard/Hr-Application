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
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:Dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:Dashboard');
    Route::get('/getVaccanciesData',[DashboardController::class,'getVaccanciesData']);

    //Users Routes
    Route::get('/users/profile', [UserController::class, 'profile'])->name('users.profile')->middleware('permission:Users');
    Route::resource('users', UserController::class)->middleware('permission:Users');
    Route::get('/getusers', [UserController::class, 'getUsersByRole'])->middleware('permission:Users');
    Route::post('/lock-rule', [UserController::class, 'lockRule'])->name('lock.rule')->middleware('permission:Users');
    Route::get('/check-temp-pass', [UserController::class, 'checkTempPass'])->name('check.temp.pass')->middleware('permission:Users');
    Route::get('/lock-screen', [UserController::class, 'lockScreen'])->name('users.lock')->middleware('permission:Users');
    Route::post('/unlock-screen', [UserController::class, 'unlockScreen'])->name('users.unlock')->middleware('permission:Users');

    //Employees Routes
    Route::delete('/delete-file', [EmployeesController::class, 'delete'])->name('delete.file')->middleware('permission:Employees');
    Route::delete('/employees/bulk-delete', [EmployeesController::class, 'bulkDelete'])->name('employees.bulkDelete')->middleware('permission:Employees');
    Route::resource('employees', EmployeesController::class)->middleware('permission:Employees');
    Route::get('/get-employees-info', [EmployeesController::class, 'getEmployeeInfo'])->middleware('permission:Employees');
    Route::get('/employee-files/{employeeName}/{pinCode}', [EmployeesController::class, 'getEmployeeFiles'])->middleware('permission:Employees');
    Route::get('/employee-files/{employeeName}/{pinCode}/download-all', [EmployeesController::class, 'downloadAllFiles'])->middleware('permission:Employees');
    Route::post('/upload-employee-files', [EmployeesController::class, 'uploadFiles'])->name('employee.uploadFiles')->middleware('permission:Employees');
    Route::get('/export-employees', function () {
        return Excel::download(new EmployeesExport(), 'employees.xlsx');
    })->name('employees.export');

    //Branches Routes
    Route::resource('/branches', BranchController::class)->middleware('permission:Branches');
    Route::get('/branches-data', [BranchController::class, 'getBranchesData'])->name('branches.data')->middleware('permission:Branches');
    Route::get('/branches-manager', [BranchController::class, 'getBranchesManager'])->middleware('permission:Branches');
    Route::get('/branches/{branch}/employees', [BranchController::class, 'fetchBranchEmployees'])->name('branches.employees')->middleware('permission:Branches');

    //Calendars Page
    Route::get('/events', [CalendarController::class, 'fetchEvents'])->middleware('permission:Calendar & Tools');
    Route::post('/events', [CalendarController::class, 'storeEvent'])->middleware('permission:Calendar & Tools');
    Route::get('/calendar', function () {
        return view('calendar');
    })->middleware('permission:Calendar & Tools');
    Route::get('/upcoming-events', [CalendarController::class, 'fetchUpcomingEvents'])->middleware('permission:Calendar & Tools');
    Route::delete('/events/{id}', [CalendarController::class, 'deleteEvent'])->middleware('permission:Calendar & Tools');
    Route::put('/events/{id}', [CalendarController::class, 'editEvent'])->middleware('permission:Calendar & Tools');
    Route::get('/events/{id}', [CalendarController::class, 'fetchEvent'])->middleware('permission:Calendar & Tools');

    //Titles routes
    Route::resource('titles', TitleController::class)->middleware('permission:Titles');
    Route::post('/titles/update-ranks', [TitleController::class, 'updateRanks'])->name('titles.updateRanks')->middleware('permission:Titles');
    Route::get('/titles/{id}', [TitleController::class, 'show'])->middleware('permission:Titles');
    Route::delete('/titles/{id}', [TitleController::class, 'destroy'])->name('titles.destroy')->middleware('permission:Titles');
    Route::get('/get-titles-data', [TitleController::class, 'getTitleData'])->middleware('permission:Titles');

    //Vacancies routes
    Route::get('/vacancies/fetch', [VacancyController::class, 'fetch'])->name('vacancies.fetch')->middleware('permission:Vacancies');
    Route::resource('vacancies', VacancyController::class)->middleware('permission:Vacancies');

    //Transfers routes
    Route::post('/send-transfer-email', [TransferController::class, 'sendTransferEmail'])->name('sendTransferEmail')->middleware('permission:Trasnfers/Rotation');
    Route::resource('transfers', TransferController::class)->middleware('permission:Trasnfers/Rotation');
    Route::post('/transfers/apply', [TransferController::class, 'applyTransfer'])->name('transfers.apply')->middleware('permission:Trasnfers/Rotation');
    Route::post('/transfers/{id}/cancel', [TransferController::class, 'cancelTransfer'])->name('transfers.cancel')->middleware('permission:Trasnfers/Rotation');
    Route::get('/transfers/{id}/pdf', [TransferController::class, 'generatePDF'])->name('transfers.pdf')->middleware('permission:Trasnfers/Rotation');
    Route::post('/transfers/{id}/change-action-type', [TransferController::class, 'changeActionType'])->name('transfers.changeActionType')->middleware('permission:Trasnfers/Rotation');

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
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy')->middleware('permission:Promotions');
    Route::resource('promotions', PromotionController::class)->middleware('permission:Promotions');
    Route::get('/getAllPromo', [PromotionController::class, 'getAllPromo'])->middleware('permission:Promotions');
    Route::get('/promotion-stats', [PromotionController::class, 'getPromotionStats'])->middleware('permission:Promotions');
    Route::get('/promotions/{id}/download', [PromotionController::class, 'downloadPromotionLetter'])->name('promotions.download')->middleware('permission:Promotions');

    //Barcode Routes
    Route::get('/badge', [BadgeController::class, 'index'])
        ->name('badge.index')
        ->middleware('permission:Badge Maker');
    Route::post('/badge/generate', [BadgeController::class, 'generateBadge'])
        ->name('badge.generate')
        ->middleware('permission:Badge Maker');
    Route::get('/getEmployeesByBranch/{branchId}', [BadgeController::class, 'getEmployeesByBranch'])->middleware('permission:Badge Maker');

    //New Joiners System Routes
    Route::get('/employee-progress/{id}', [NewJoinerController::class, 'getEmployeeProgress'])->middleware('permission:New Joiners');
    Route::get('/new-joiners-data', [NewJoinerController::class, 'getNewJoinersData'])->middleware('permission:New Joiners');
    Route::resource('new-joiners', NewJoinerController::class)->middleware('permission:New Joiners');
    Route::post('/save-phase-progress', [NewJoinerController::class, 'savePhaseProgress'])->middleware('permission:New Joiners');
    Route::get('/progress/{newJoinerId}', [NewJoinerProgressController::class, 'showProgress'])->middleware('permission:New Joiners');
    Route::post('/progress/complete', [NewJoinerProgressController::class, 'completeStep'])->middleware('permission:New Joiners');
    Route::post('/progress/init/{newJoinerId}', [NewJoinerProgressController::class, 'initializeProgress'])->middleware('permission:New Joiners');
    Route::get('/new-joiners/filter/{stepId}', [NewJoinerController::class, 'filterByStep'])->middleware('permission:New Joiners');
    Route::delete('/new-joiners/{id}', [NewJoinerController::class, 'destroy'])->middleware('permission:New Joiners');

    //Notification System
    Route::get('/notifications', [NotificationController::class, 'fetchNotifications']);
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    //Training Steps API
    Route::resource('steps', TrainingStepsController::class)->middleware('permission:New Joiners');
    Route::get('/getSteps', [TrainingStepsController::class, 'getStepData'])->middleware('permission:New Joiners');
    Route::post('/steps/update-ranks', [TrainingStepsController::class, 'updateRanks'])->name('steps.updateRanks')->middleware('permission:New Joiners');

    //Roles And Permissions API:
    Route::get('add-permission', [RolesAndPermissionController::class, 'addPermissions'])->middleware('permission:Role And Permission');
    Route::resource('roles', RolesAndPermissionController::class)->middleware('permission:Role And Permission');
    Route::get('/getroles', [RolesAndPermissionController::class, 'getRoles'])->middleware('permission:Role And Permission');
    Route::put('/roles/{id}', [RolesAndPermissionController::class, 'update'])->name('roles.update')->middleware('permission:Role And Permission');
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
    return Auth::check() ? redirect('/dashboard') : redirect('/login');
});

//Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
