<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function createdBy(){
        return $this->belongsTo(Admin::class, "created_by");
    }
    public function updatedBy(){
        return $this->belongsTo(Admin::class, "updated_by");
    }
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
