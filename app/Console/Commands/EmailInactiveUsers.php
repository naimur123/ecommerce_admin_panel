<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\EmailInactiveUsers as NotificationsEmailInactiveUsers;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EmailInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Inactive Users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         $date = Carbon::now()->subDay(7);
         $inactive = User::where('last_login','<',$date)->get();
        //  $this->info($inactive);
        foreach($inactive as $users){
            $users->notify(new NotificationsEmailInactiveUsers());
            $this->info('Email sent to '.$users->email);
        }
    }
}
