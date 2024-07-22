<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\Admincontroller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\LogController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function() {
  Route::get('admin/dashbared', [FileController::class, 'index'])->name('admin.dashbared');
    Route::post('upload', [FileController::class, 'uploadadmin'])->name('upload');
    Route::middleware(['checkFileAvailability','role:admin'])->group(function () {

    Route::get('/download/{filename}', [FileController::class, 'download'])->name('admin.download');
  });
    Route::delete('/delete/{filename}', [FileController::class, 'delete'])->name('delete');
    Route::get('/reports/file/{file}', [ReportsController::class, 'fileReport'])->name('file.report');
      Route::post('/admin/approve/{userId}', [FileController::class, 'approveUser'])->name('approve');
        Route::post('/admin/reject/{userId}', [FileController::class, 'rejectUser'])->name('reject');
        Route::post('/admin/addUserToGroup/{user_id}', [UserGroupController::class, 'addUserToGroup'])->name('addUserToGroup');


Route::post('/request-logs', [ReportsController::class, 'showRequestLogs'])->name('request-logs.index');


});
//Route::get('/dash',[FileController::class, 'index']);

require __DIR__.'/auth.php';


  Route::get('/user/dash', [FileController::class, 'userindex'])->name('user.dash');
  Route::middleware(['checkFileAvailability','role:user'])->group(function () {
  Route::get('/download/user/{filename}', [FileController::class, 'download'])->name('download');
});

  Route::delete('/delete/user/{filename}', [FileController::class, 'delete'])->name('user.delete');

 Route::post('upload/user', [FileController::class, 'uploaduser'])->name('user.upload');

 Route::post('/user/downloadMultiple', [FileController::class, 'downloadMultiple'])->name('user.downloadMultiple');


    Route::get('/reports/file/{file}', [ReportsController::class, 'fileReport'])->name('file.report');


Route::get('/group/create', [GroupController::class, 'create'])->name('group.create');
Route::post('/group/store', [GroupController::class, 'store'])->name('group.store');
