<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','purchase_price', 'sale_price',"img","stoke", "category_id"];
    protected $appends = ["image_path", "profit_percent"];

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function getImagePathAttribute(){
        return asset('uploadImage/productImage/'. $this->img);
    }//end of get image path 


    public function getProfitPercentAttribute(){
        $profit = $this->purchase_price - $this->sale_price;
        $percent = $profit * 100 / $this->purchase_price;
        return number_format($percent, 2); 
    }

}
