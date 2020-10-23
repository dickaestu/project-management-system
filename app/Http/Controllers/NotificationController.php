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



        return view('pages.notification', compact('notifications'));
    }

    // Project Member
    public function get()
    {
        $notifications = Auth::user()->unreadNotifications->take(10);

        return $notifications;
    }
}
