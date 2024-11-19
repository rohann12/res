<?php

namespace Modules\Visitor\Routes;

use Illuminate\Support\Facades\Route;
use Modules\BusinessOperations\Controllers\CompanyController;
use Modules\BusinessOperations\Controllers\ProjectController;
use Modules\Visitor\Controllers\VisitorController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::prefix('projects')->group(function () {
            Route::get('/', [ProjectController::class, 'index'])->name('project.index');
            Route::get('/projects/filter/{status}', [ProjectController::class, 'filterByStatus'])->name('project.filterByStatus');
            Route::get('/create', [ProjectController::class, 'create'])->name('project.create');
            Route::post('/', [ProjectController::class, 'store'])->name('project.store');
            Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
            Route::put('/{project}/update', [ProjectController::class, 'update'])->name('project.update');
            Route::delete('/{project}/destroy', [ProjectController::class, 'destroy'])->name('project.destroy');
        });

        Route::prefix('company')->group(function () {
            Route::get('details', [CompanyController::class, 'index'])->name('company.index');
            Route::get('edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
            Route::put('update/{id}', [CompanyController::class, 'update'])->name('company.update');
        });
    });
});

