<?php

namespace App\Http\Controllers;

use App\Service\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function __construct(
        protected NotificationService $notificationService
    )
    {
    }

    function index()
    {
        $notifications = $this->notificationService->getNotification();
        return view('modules.notification.index', compact('notifications'));
    }

    function markAsRead($id)
    {
        $this->notificationService->markAsRead($id);
        return redirect()->back();

    }

    function getUnreadCount(){
        $count=$this->notificationService->getUnreadCount();
        return response()->json(['count' => $count]);
    }
}
