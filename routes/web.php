<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Models\Message;

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

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'admin'])->group(function () {
        // Route::prefix('projects')->group(function () {
        //     Route::get('/', [ProjectController::class, 'index'])->name('project.index');
        //     Route::get('/projects/filter/{status}', [ProjectController::class, 'filterByStatus'])->name('project.filterByStatus');
        //     Route::get('/create', [ProjectController::class, 'create'])->name('project.create');
        //     Route::post('/', [ProjectController::class, 'store'])->name('project.store');
        //     Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
        //     Route::put('/{project}/update', [ProjectController::class, 'update'])->name('project.update');
        //     Route::delete('/{project}/destroy', [ProjectController::class, 'destroy'])->name('project.destroy');
        // });


        // Route::prefix('careers')->group(function () {
        //     Route::get('/', [CareerController::class, 'index'])->name('careers.index');
        //     Route::get('/careers/filter/{type}', [CareerController::class, 'filterByType'])->name('careers.filterByType');

        //     Route::get('/create', [CareerController::class, 'create'])->name('careers.create');
        //     Route::post('/', [CareerController::class, 'store'])->name('careers.store');
        //     Route::get('/{career}/edit', [CareerController::class, 'edit'])->name('careers.edit');
        //     Route::put('/{career}/update', [CareerController::class, 'update'])->name('careers.update');
        //     Route::delete('/{career}/destroy', [CareerController::class, 'destroy'])->name('careers.destroy');
        // });

        // Route::prefix('careers')->group(function () {
        //     Route::get('/', [CareerController::class, 'index'])->name('careers.index');
        //     Route::get('/create', [CareerController::class, 'create'])->name('careers.create');
        //     Route::post('/', [CareerController::class, 'store'])->name('careers.store');
        //     Route::get('/{career}/edit', [CareerController::class, 'edit'])->name('careers.edit');
        //     Route::put('/{career}/update', [CareerController::class, 'update'])->name('careers.update');
        //     Route::delete('/{career}/destroy', [CareerController::class, 'destroy'])->name('careers.destroy');
        // });

        Route::prefix('clients')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('client.index');
            Route::get('/employees/status/{status}', [EmployeeController::class, 'filterByStatus'])->name('employees.filterByStatus');
            Route::get('/create', [ClientController::class, 'create'])->name('client.create');
            Route::post('/', [ClientController::class, 'store'])->name('client.store');
            Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('client.edit');
            Route::put('/{client}/update', [ClientController::class, 'update'])->name('client.update');
            Route::delete('/{client}/destroy', [ClientController::class, 'destroy'])->name('client.destroy');
        });

        Route::prefix('employees')->group(function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
            Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
            Route::post('/store', [EmployeeController::class, 'store'])->name('employees.store');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
            Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
            Route::delete('/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
        });

        // Route::prefix('company')->group(function () {
        //     Route::get('details', [CompanyController::class, 'index'])->name('company.index');
        //     Route::get('edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
        //     Route::put('update/{id}', [CompanyController::class, 'update'])->name('company.update');
        // });

        // Route::prefix('company')->group(function () {
        //     Route::get('details', [CompanyController::class, 'index'])->name('company.index');
        // });

        // Route::prefix('services')->group(function () {
        //     Route::get('/', [ServiceController::class, 'index'])->name('service.index');
        //     Route::get('/create', [ServiceController::class, 'create'])->name('service.create');
        //     Route::post('/', [ServiceController::class, 'store'])->name('service.store');
        //     Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
        //     Route::put('/{service}/update', [ServiceController::class, 'update'])->name('service.update');
        //     Route::delete('/{service}/destroy', [ServiceController::class, 'destroy'])->name('service.destroy');
        // });
        // Route::prefix('news')->group(function () {
        //     Route::get('/', [NewsController::class, 'index'])->name('news.index');
        //     Route::get('/news/type/{type}', [NewsController::class, 'filterByType'])->name('news.filterByType');
        //     Route::get('/create', [NewsController::class, 'create'])->name('news.create');
        //     Route::post('/', [NewsController::class, 'store'])->name('news.store');
        //     Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        //     Route::put('/{news}/update', [NewsController::class, 'update'])->name('news.update');
        //     Route::delete('/{news}/destroy', [NewsController::class, 'destroy'])->name('news.destroy');
        // });
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
});
