<?php 

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Dashboard\userController;
use App\Http\Controllers\Dashboard\dashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;

    Route::get("/dashboard/",[dashboardController::class , "index"])->name("dashboard");
    //Route::get("/users",[userController::class , "index"])->name("users");
    Route::resource('dashboard/users', userController::class);
    Route::resource('dashboard/category', CategoryController::class);
    Route::resource('dashboard/product', ProductController::class);



