<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Kenakata</title>
        <style type="text/css">
            @import url(http://fonts.googleapis.com/css?family=Lato:400);

            /* Take care of image borders and formatting */
            *{
                font-family: 'Lato', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                font-size: 17px;
            }

            h3 {color: #21c5ba; font-size: 24px; }
            .mt-5{margin-top: 25px; }
            .mt-3{margin-top: 15px; }
            .mt-2{margin-top: 10px; }
            .pt-2{padding-top: 10px; }
            .mb-2{margin-bottom: 10px; }
            .pb-2{padding-bottom: 10px; }
            .template{background:#eee;}
            .layout{width: 75%; margin: 0px auto;background-color: #fff; padding: 10px 15px;}
            .text-center{text-align: center;}
            .footer{font-size: 12px;}
        </style>

        <style type="text/css" media="screen">
            @media screen {
                /* Thanks Outlook 2013! http://goo.gl/XLxpyl*/
                td, h1, h2, h3 {
                    font-family: 'Lato', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        
    </head>
    <body class="body template">
        <div class="pb-2 pt-2">
            <h3 class="text-center"> Kenakata</h3>
        </div>
        <div class="layout">
            <div class="mt-2 mb-2">
                {!! $mail_message ?? "" !!}
            </div>
            <?php 
             $time = \Carbon\Carbon::now();
             $str = Str::random(10);
             $token = $time.$str;
            //  $verificationUrl = URL::temporarySignedRoute('email.verified', now()->addMinutes(30), ['user' => $user]);
            ?>
            <div class="mt-2 mb-2">
                {{-- <a href="{{ route('email.verified', $id) }}" role="button">Click Here</a>To verify --}}
                <a href="{{ route('email.verified',['token'=>$token,'id'=>$id]) }}" role="button">Click Here</a>To verify
            </div>
        </div>
        <div class="pb-2 pt-2 footer text-center">
            {!! $mail_footer ?? " " !!}
        </div>
    </body>
</html>
