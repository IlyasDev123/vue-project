<?php

namespace App\Services;

use App\Models\Notification;
use App\Traits\NotificationTrait;

class NotificationService
{
    use NotificationTrait;

    public function markAllAsRead()
    {
        try {
            $notification = Notification::where('receiver_id', auth()->id())->where('is_read', false)
                ->update([
                    'is_read' => true,
                ]);

            return $notification;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function markAsRead($request)
    {
        try {
            $notification = Notification::whereIn('id', $request->notification_id)
                ->update([
                    'is_read' => true,
                ]);

            return $notification;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getNotification()
    {
        $user = auth()->id();
        return $this->getNotifications($user);
    }
}
