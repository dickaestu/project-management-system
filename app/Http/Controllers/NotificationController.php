<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Exception;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function get()
    {
        try {
            $notifications = Auth::user()->unreadNotifications;

            foreach ($notifications as $notification) {

                $response[] = [
                    'data' => $notification->data,
                    'created_at' => $notification->created_at->diffForHumans(),
                    'read_at' => $notification->read_at
                ];
            }


            return json_encode($response);
        } catch (Exception $e) {
            return "message: No Notification";
        }
    }

    // public function read(Request $request)
    // {
    //     Auth::user()->unreadNotifications()->find($request->id)->markAsRead();
    //     return 'success';
    // }
}
