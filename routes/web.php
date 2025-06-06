<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaptismalRecordController;
use App\Models\BaptismalRecord;


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
    if(Auth::user()->roles[0]->name == "parish_priest")
    {
       // return Auth::user()->roles[0]->name;
        return view('parish_priest.dashboard');
    }
    else
    {
        // return Auth::user()->roles[0]->name;

        //dtuy mabalin ka ag query
        $baptismalRecords = BaptismalRecord::all();
        //dd($baptismalRecords);
        return view('secretary.dashboard', compact('baptismalRecords'));
    } 
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// admin routes here 
Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:admin-access')->group(function(){

    // add routes here for admin 
    Route::resource('/users','UserController',['except' => ['create','store','destroy']]);
    Route::get('/userfeedbacks','UserController@userfeedback')->name('userfeedback');
   
});




// users routes here 
Route::namespace('App\Http\Controllers\Users')->prefix('users')->name('users.')->middleware('can:user-access')->group(function(){

    // add routes here for users 
    Route::resource('/feedback','CTRLFeedbacks',['except' => ['update','edit','destroy']]);

});





require __DIR__.'/auth.php';
