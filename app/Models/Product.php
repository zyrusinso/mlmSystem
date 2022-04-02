<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function productListOfSubCategory($selectedCategory, $selectedSubCategory){
        $data = [];
        $productBySubCategory = static::where('category_id', $selectedCategory)
                                        ->where('sub_category_id', $selectedSubCategory)->get();

        foreach($productBySubCategory as $item){
            $data += [$item->id => $item->product_name];
        }

        return $data;
    }

    public static function productList(){
        $data = [];
        $product = static::all();

        foreach($product as $item){
            $data += [$item->id => $item->product_name];
        }

        return $data;
    }
}
