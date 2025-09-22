<?php

use App\Http\Controllers\CustomValidationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

Route::post('/custom-validation', CustomValidationController::class)
    ->withoutMiddleware([ValidateCsrfToken::class]);
