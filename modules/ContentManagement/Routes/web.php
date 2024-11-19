<?php

use Illuminate\Support\Facades\Route;
use Modules\ContentManagement\Controllers\NewsController;
use Modules\ContentManagement\Controllers\ServiceController;
use Modules\Visitor\Controllers\VisitorController;

Route::get('/testModule', function () {
    echo 'hello';
});

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::prefix('services')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('service.index');
            Route::get('/create', [ServiceController::class, 'create'])->name('service.create');
            Route::post('/', [ServiceController::class, 'store'])->name('service.store');
            Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
            Route::put('/{service}/update', [ServiceController::class, 'update'])->name('service.update');
            Route::delete('/{service}/destroy', [ServiceController::class, 'destroy'])->name('service.destroy');
        });
        Route::prefix('news')->group(function () {
            Route::get('/', [NewsController::class, 'index'])->name('news.index');
            Route::get('/news/type/{type}', [NewsController::class, 'filterByType'])->name('news.filterByType');
            Route::get('/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/', [NewsController::class, 'store'])->name('news.store');
            Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
            Route::put('/{news}/update', [NewsController::class, 'update'])->name('news.update');
            Route::delete('/{news}/destroy', [NewsController::class, 'destroy'])->name('news.destroy');
        });
    });
});