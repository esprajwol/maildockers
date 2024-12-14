<?php

namespace App\Services\Notification;

use App\Notifications\CodeScannedNotification;
use App\Services\Models\User\UserService;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    public function sendQrCodeScanNotificationToDistributor(object $code, object $information)
    {
        $distributor = $code->user;

        if ($distributor) {
            // sending notification
            if($distributor->setting && $distributor->setting->is_enable_notification) {
                Notification::send($distributor, new CodeScannedNotification($code, $information));
            }

            // Partner Notification Sending
            if ($distributor->parentUser) {

                $partner = $distributor->parentUser;

                if($partner->setting && $partner->setting->is_enable_notification) {
                    Notification::send($partner, new CodeScannedNotification($code, $information));
                }
            }
        }

        return $code;
    }

    public function sendQrCodeScanNotificationToAdmin(object $code, object $information)
    {
        $admin = (new UserService())->findByColumn(["user_type", "=", appStatic()::TYPE_ADMIN], false , true);

        if ($admin) {

            // sending notification
            Notification::send($admin, new CodeScannedNotification($code, $information));
        }

        return $code;
    }

    public function markNotificationAsReadById($notificationId)
    {
        return user()->unreadNotifications
            ->when($notificationId, function ($query) use ($notificationId) {
                return $query->where('id', $notificationId);
            })
            ->markAsRead();

    }

}
