<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    public function createdBy(){
        return $this->belongsTo(Admin::class, "created_by");
    }
    public function updatedBy(){
        return $this->belongsTo(Admin::class, "updated_by");
    }
}
