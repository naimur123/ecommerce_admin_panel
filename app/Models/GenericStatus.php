<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenericStatus extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function createdBy(){
        return $this->belongsTo(Admin::class, "created_by");
    }
    public function updatedBy(){
        return $this->belongsTo(Admin::class, "updated_by");
    }

    // protected $guarded = [];
    // protected $fillable = ['name','short_name','created_by','updated_by','created_at','updated_at'];
}
