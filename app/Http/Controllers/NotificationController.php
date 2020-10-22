<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Exception;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications;

        foreach ($notifications as $notification) {
            $data = (object)$notification->data;

            $items[] = [
                'message' => $data->message,
                'created_at' => $notification->created_at->format('d, F Y'),
                'read_at' => $notification->read_at,
                'projects_id' => $data->projects_id
            ];
        }

        return view('pages.notification', compact('items'));
    }

    // Project Member
    public function get()
    {
        $notifications = Auth::user()->unreadNotifications->take(10);

        return $notifications;
    }
}
