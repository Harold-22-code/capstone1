<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaptismalRecordController;
use App\Models\BaptismalRecord;
Use App\Models\Schedule;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// route for the landing page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/baptismal', [BaptismalRecordController::class, 'index'])->name('baptismal.index');



// redirects to specific dashboard based on the role of the user
Route::get('/dashboard', function () {
    $user = Auth::user();
    $role = $user->roles->first();
    if ($role && $role->name == "parish_priest") {
        // Fetch schedules with event and user relationships, latest first
        $schedule = Schedule::with('event', 'user')->latest()->get();
        return view('parish_priest.dashboard')->with(compact('schedule'));
    } else {
        $baptismalRecords = BaptismalRecord::all();
        return view('secretary.dashboard', compact('baptismalRecords'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// admin routes here
Route::
        namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:parish_priest-access')->group(function () {

            // add routes here for admin
            Route::resource('/users', 'UserController', ['except' => ['create', 'store', 'destroy']]);
            Route::get('/userfeedbacks', 'UserController@userfeedback')->name('userfeedback');

            Route::get('/schedule-form', 'AdminScheduleController@SchedulingForm')->name('schedule-form');

            Route::post('/save-schedule', 'AdminScheduleController@saveSchedule')->name('save-schedule');
        });




// users routes here
Route::
        namespace('App\Http\Controllers\Users')->prefix('users')->name('users.')->middleware('can:secretary-access')->group(function () {

            Route::get('/add-baptism-record', 'AddRecordController@baptismalform')->name('add-baptism-record');

            Route::get('/add-wedding-record', 'AddRecordController@weddingform')->name('add-wedding-record');

            Route::post('/save-baptism-record', 'AddRecordController@SaveBapRecord')->name('save-baptism-record');

            Route::post('/save-wedding-record', 'AddRecordController@SaveWedRecord')->name('save-wedding-record');

            Route::post('/update-baptism-record/{id}', 'AddRecordController@updateBapRecord')->name('update-baptism-record');

            Route::post('/update-wedding-record/{id}', 'AddRecordController@updateWedRecord')->name('update-wedding-record');

            Route::get('/burial-form', 'AddRecordController@burialform')->name('burial-form');

            Route::post('/save-burial-record', 'AddRecordController@AddBurialRec')->name('save-burial-record');

            Route::post('/update-burial-record/{id}', 'AddRecordController@updateBurialRecord')->name('update-burial-record');

            Route::get('/confirm-form', 'AddRecordController@confirmform')->name('confirm-form');

            Route::post('/save-confirm-record', 'AddRecordController@AddConfirmationRec')->name('save-confirm-record');

            Route::post('/update-confirm-record/{id}', 'AddRecordController@updateConfirmRecord')->name('update-confirm-record');

            Route::post('/update-confirmation-record/{id}', 'AddRecordController@updateConfirmationRecord')->name('update-confirmation-record');

            Route::get('/schedule-form', 'SchedulerController@SchedulingForm')->name('schedule-form');

            Route::post('/save-schedule', 'SchedulerController@saveSchedule')->name('save-schedule');

        });


// Allow both parish priests and secretaries to update schedules
Route::post('/users/update-schedule/{id}', [App\Http\Controllers\Users\SchedulerController::class, 'updateSchedule'])->name('update-schedule')->middleware(['auth', 'verified']);




require __DIR__ . '/auth.php';
