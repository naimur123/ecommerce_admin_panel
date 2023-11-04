<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function createdBy(){
        return $this->belongsTo(Admin::class, "created_by");
    }
    public function updatedBy(){
        return $this->belongsTo(Admin::class, "updated_by");
    }
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
    public function status(){
        return $this->belongsTo(GenericStatus::class,'status_id');
    }
    public function orderProduct(){
        return $this->hasMany(OrderDetails::class);
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'product_id');
    }
    protected $fillable = [
        'name', 'quantity'
    ];
}
