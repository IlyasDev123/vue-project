<?php

namespace App\Traits;

use App\Utlities\Constants;
use App\Models\Notification;


trait NotificationTrait
{
    public function sendNotification($query)
    {
        try {
            return  Notification::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $query->talent_id ?? null,
                'position_id' => $query->position_id,
                'user_id' => $query->recruiter_id ?? null,
                'status' => $query->status,
                'type' => $query->type,
                'content' => $query->content,
            ]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getNotifications($id)
    {
        return Notification::where('receiver_id', $id)->where('is_read', false)->with('sender', 'receiver', 'position.profession', 'position.company')->get();
    }
}
