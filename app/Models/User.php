<?php

namespace App\Models;

use App\Events\UserCreated;
use App\Notifications\EmailVerifyNotification;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use \Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    // public function sendEmailVerificationNotification(){
    //     $this->notify(new EmailVerifyNotification($this));
    // }
    protected $dispatchesEvents = [
       'created' => UserCreated::class
    ];
    
}
