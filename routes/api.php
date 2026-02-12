<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\RoleMiddleWare;
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

//creating apis which can be accessed by logged in user only 

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/check', function () {
    return response()->json([
        'status' => true,
        'message' =>'check API working 🎉'
    ]);
});


    //api start from here 
    Route::get('/logout',[ AuthController::class, 'logout'])->name('logout');

    Route::get('/admin', function(){
        return response()->json(
            [
                'status' => 'Success',
                'message' => 'Middleware in admin is perfectly working'
            ]
        );

    })->middleware('role:admin');


});


