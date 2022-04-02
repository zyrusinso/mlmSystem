<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function mainProductCategoryList(){
        $data = [];
        $mainCategory = ProductCategory::all();

        foreach($mainCategory as $item){
            $data += [$item->id => $item->category_name];
        }

        return $data;
    }

    public static function subCategoryOfMainCategory($mainCategory){
        $data = [];
        $subCategoryList = ProductSubCategory::where('category_id', $mainCategory)->get();

        foreach($subCategoryList as $item){
            $data += [$item->id => $item->sub_cat_name];
        }

        return $data;
    }

    public static function productSubCategory(){
        $data = [];
        $mainCategory = static::all();

        foreach($mainCategory as $item){
            $data += [$item->id => $item->category_name];
        }

        return $data;
    }
}
