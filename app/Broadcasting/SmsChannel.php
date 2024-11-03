<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SmsChannel
{
    public function send($notifiable , Notification $notification)
    {

        if (!method_exists($notification, 'toSms')) {
            throw new \Exception('toSms method not found');
        }

        try
        {
            $data = $notification->toSms($notifiable);
            $receptor = $data['phone_number'];
            $code = $data['code'];
            $url ='https://api.limosms.com/api/sendpatternmessage';
 
            $post_data = json_encode(array(
            'OtpId' => '716' ,
            'ReplaceToken' => [$code],
            'MobileNumber' => $receptor 
            ));         
          
            $process = curl_init();
            curl_setopt( $process,CURLOPT_URL,$url);
            curl_setopt( $process, CURLOPT_TIMEOUT,30);
            curl_setopt( $process, CURLOPT_POST, 1);
            curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt( $process, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt( $process, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt( $process, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt( $process, CURLOPT_HTTPHEADER, array('Content-Type: application/json'
            ,'ApiKey:eb9863cc-852b-4be5-a22c-f7ab8ed3b2c7'));
            $return = curl_exec( $process);
            $httpcode = curl_getinfo( $process, CURLINFO_HTTP_CODE);
            curl_close($process);
            $decoded = json_decode($return);
        }
        catch(ApiException $e){
            throw $e;
        }
        catch(HttpException $e){
            throw $e;
        }
       
    }
}
