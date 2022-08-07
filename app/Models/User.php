<?php

namespace App\Models;

use App\Notifications\EmailVerifyNotification;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use \Illuminate\Auth\MustVerifyEmail;

class User extends Model
{
    use HasFactory;
    use Notifiable;

    // public function sendEmailVerificationNotification(){
    //     $this->notify(new EmailVerifyNotification($this));
    // }
}
