<?php

use Illuminate\Support\Facades\Route;
use SearchAll\Infrastructure\Entrypoint\Http\SearchAllController;

Route::group([
    'prefix' => 'searchAll',
    'middleware' => ['auth']
],
    function () {
        Route::middleware([
            config('jetstream.auth_session'),
            'verified'
        ])->group(function () {
            Route::group([
                'prefix' => 'searchAll-create',
            ], function () {
                Route::post('/', [SearchAllController::class, 'createAndGet'])->name('searchAll-create');
                Route::post('/detele', [SearchAllController::class, 'delete'])->name('searchAll-delete');
            });
        });
    }

);