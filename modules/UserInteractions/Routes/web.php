<?php


use Illuminate\Support\Facades\Route;
use Modules\UserInteractions\Controllers\UserController;
use Modules\UserInteractions\Controllers\VisitorController;

Route::get('/testModule', function () {
    echo 'hello';
});

Route::get('user/profile', [UserController::class, 'edit'])->name('user.edit');
Route::put('user/update/{user}', [UserController::class, 'update'])->name('user.update');
Route::put('changePassword/{user}', [UserController::class, 'changePassword'])->name('changePassword');

Route::get('login', [UserController::class, 'loginView'])->name('login');
Route::post('login', [UserController::class, 'loginPost'])->name('loginPost');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('password/reset', [UserController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [UserController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [UserController::class, 'reset'])->name('password.update');


Route::get('/', [VisitorController::class, 'index'])->name('home');
Route::get('/employeeDetails/{employeeId}', [VisitorController::class, 'employeeDetails'])->name('employeeDetails');
Route::get('carousel', [VisitorController::class, 'carousel']);
Route::get('contact', [VisitorController::class, 'contact'])->name('contact');
Route::get('about', [VisitorController::class, 'about'])->name('about');
Route::get('news&insights', [VisitorController::class, 'news'])->name('news');
Route::get('updates/{newsId}', [VisitorController::class, 'updates'])->name('updates');
Route::get('services', [VisitorController::class, 'services'])->name('services');
Route::get('services/{serviceId}', [VisitorController::class, 'serviceView'])->name('serviceView');
Route::get('projects', [VisitorController::class, 'projects'])->name('projects');
Route::get('createMessage', [VisitorController::class, 'create']);
Route::post('postMessage', [VisitorController::class, 'store'])->name('postMessage');