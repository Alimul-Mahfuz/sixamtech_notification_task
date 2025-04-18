<?php

namespace App\Service;

use App\Models\Notification;

class NotificationService
{
    function create(string $title, string $body, int $receiver_id)
    {
        $auth_user = auth()->user();
        $notification = [
            'title' => $title,
            'body' => $body,
            'read' => false,
            'sender_id' => $auth_user->id,
            'receiver_id' => $receiver_id
        ];
        return Notification::query()->create($notification);

    }

    function getNotification()
    {
        $auth_user = auth()->user();
        return Notification::query()
            ->where('receiver_id', $auth_user->id)
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }
}
