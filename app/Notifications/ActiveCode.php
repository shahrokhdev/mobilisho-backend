<?php

namespace App\Notifications;

use App\Broadcasting\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActiveCode extends Notification implements ShouldQueue
{
    use Queueable;

     public $code;

     public $phone_number;

    public function __construct($code, $phone_number)
    {
        $this->code = $code;
        $this->phone_number = $phone_number;
    }

    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    public function toSms($notifiable)
    {
        return [
            'phone_number' => $this->phone_number,
            'code' => $this->code
        ];
    }
}
