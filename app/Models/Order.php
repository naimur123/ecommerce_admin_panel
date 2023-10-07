<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function orderDetails(){
       return $this->hasMany(OrderDetails::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function shipping(){
        return $this->belongsTo(ShippingAddress::class,'shipping_id');
    }
    public function paymentType(){
        return $this->belongsTo(PaymentType::class,'payment_type_id');
    }
}
