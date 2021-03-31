<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic as Image;


class ProductController extends Controller
{

    public function __construct(){

        
        $this->middleware(['permission:products_read'])->only('index');
        $this->middleware(['permission:products_create'])->only('create');
        $this->middleware(['permission:products_update'])->only('edit');
        $this->middleware(['permission:products_delete'])->only('destroy');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {           $categories = Category::all();

        $products = Product::latest()->paginate(5);;
        return view("dashboard.product.index",compact("products" , "categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("dashboard.product.create" , compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'description'=> "required",
            'purchase_price'     => "required",
            'sale_price'   =>"required",
            "stoke" =>"required",
            "category_id" =>"required",
            'img'  =>"image"

        ]);
        

        $request_data = $request->except(['img']);
        

        if($request->img){

            Image::make($request->img)->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("uploadImage/productImage/". $request->img->hashName() ));
            $request_data['img'] = $request->img->hashName();

        }//end of image request


        Product::create($request_data);
        session()->flash("success", __("Product Added"));
        return redirect(Route("product.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
            ///show
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view("dashboard.product.edit", compact("product","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => "required",
            'description'=> "required",
            'purchase_price'     => "required",
            'sale_price'   =>"required",
            "stoke" =>"required",
            "category_id" =>"required",
            'img' =>"image"

        ]);
        

        $request_data = $request->except(['img']);
        
       
        if($request->img){

            if($product->img != 'def.png'){
                Storage::disk("public_upload")->delete('/productImage/'. $product->img);
            }
            Image::make($request->img)->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("uploadImage/productImage/". $request->img->hashName() ));
            $request_data['img'] = $request->img->hashName();

        }//end of image request


        $product->update($request_data);
        session()->flash("success", __("Product Updated"));
        return redirect(Route("product.index"));      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->img != 'def.png'){
            Storage::disk('public_upload')->delete('/productImage/'. $product->img);
        }
        $product->delete();
        session()->flash("success", __("Product Is Deleted"));
        return redirect(Route("product.index"));
    }
}
