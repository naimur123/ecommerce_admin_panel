<?php

namespace App\Notifications;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class EmailVerify extends Notification
{
    use Queueable;
    private $user;
    /**
     * Create a new notification instance.
     *
     * @return vouser
     */
    public function __construct($user)
    {
        $this->user = $user;
        // $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $email_template = EmailTemplate::where('send_email', 1)->get();
        // if($email_template == 1){
        // return (new MailMessage)
        //             ->greeting($this->details['greeting'])
        //             ->line($this->details['body'])
        //             ->line($this->details['endtext']);
        // }
        $user = $this->user;
        // $verificationUrl = URL::temporarySignedRoute('email.verified', now()->addMinutes(30), ['user' => $user]);
        $email_template = EmailTemplate::where('type', "smptp")->first();

        $subject = $email_template->subject ?? "Please verify your email address";
        $footer = $email_template->footer ?? "";
        $mail_message = $email_template->body ?? "";
        $msg_params = [
            "mail_message" => $mail_message, 
            "mail_footer" => $footer,
            "id" => $user->id,
        ];

        // if($email_template->send_email == 1){
            return (new MailMessage)
                ->subject($subject)
                ->view('frontend.email.verify', $msg_params);
                // ->action('Verify Your Account', $verificationUrl );
                // ->subject("Please verify your email address")
                //     ->line('<h3>Hello!</h3>')
                //     // ->action('Activate Your Account', $verificationUrl )
                //     ->line('Thank you for using Regulated Advice!');
           
            // return $this->sendDefaultMail($verificationUrl);
        // }
                    
                    
    }

    // public function sendDefaultMail($verificationUrl ){
    //     $account_activation_message = '<h3>Hello!</h3> Welcome ' . $this->user->name .'<br><br><br>';
    //     $account_activation_message .= '<a href="'. $verificationUrl .'" style="background:#4a8bc2; color:#fff; padding:10px 15px;" > Activate Your Account </a><br><br>';
    //     $account_activation_message .= 'Thank you for using Kenakata!<br>Regards,<br>Kenakata';
        

    //     $message =  (new MailMessage)
    //                 ->subject("Please verify your email address")
    //                 ->line('<h3>Hello!</h3> Welcome ' . $this->user->name)
    //                 ->action('Verify Your Account', $verificationUrl )
    //                 ->line('Thank you for using Kenakata!');
    //     return $message;
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
