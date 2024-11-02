<?php

use Illuminate\Support\Facades\Route;
use Category\Infrastructure\Entrypoint\Http\CategoryController;

Route::group([
    'prefix' => 'category',
    'middleware' => ['auth']
],
    function () {
        Route::middleware([
            config('jetstream.auth_session'),
            'verified'
        ])->group(function () {
            Route::group([
                'prefix' => 'category-create',
            ], function () {
                Route::post('/', [CategoryController::class, 'create'])->name('category-create');
            });
        });
    }

);