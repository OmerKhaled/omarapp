<?php

namespace App\Http\Controllers\Ui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public  function showCategoryProducts(Category $category){
    
        $products = $category->product;
        return view("categoryProducts",compact("products", "category"));
        
    }
}
