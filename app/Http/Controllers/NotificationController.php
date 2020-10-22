<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Exception;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    // Project Member
    public function get()
    {
        $notifications = Auth::user()->unreadNotifications;

        return $notifications;
    }
}
