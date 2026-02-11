<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

//this is the test for checking the api is working or not 
Route::get('/test', function () {
    return response()->json([
        'status' => true,
        'message' => 'API working 🎉'
    ]);
});

//in the below there is login routes

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


