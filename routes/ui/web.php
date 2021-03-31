<?php 

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\Ui\CategoryController;


Route::get('/', function () {
    $categories = Category::all();
    return view('index' ,compact("categories"));
});

Route::get('/category/{category}',[CategoryController::class, "showCategoryProducts"] );




