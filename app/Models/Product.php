<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function brands(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id');
    }
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }
}
