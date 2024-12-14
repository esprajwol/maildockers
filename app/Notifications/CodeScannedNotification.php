<?php

namespace App\Notifications;

use App\Models\Code;
use App\Models\Information;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CodeScannedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $code;
    public $information;
    public function __construct($code, $information)
    {
        $this->code = $code;
        $this->information = $information;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        
        return [
            "distributor" => $this->code->user->fullName,
            "code_id" => $this->code->id,
            "total_scanned" => $this->code->scanned,
            "scanned_date_time" => $this->code->created_at,
            "model_name" => $this->code->model?->model_name,
            "security_no" => $this->code->security_no,
           // "url" => currentUrl(),
        ];
    }
}
