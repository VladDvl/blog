<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class NotificationController extends Controller
{
    public function deleteAllNotifications()
    {
        $user_id = $_POST['user_id'];
        $user = User::where('id', $user_id)->first();

        if( isset($user) ) {

            $user->notifications()->delete();
            
        }

        return redirect()->back();
    }

    public function deleteNotification()
    {
        $user_id = $_POST['user_id'];
        $user = User::where('id', $user_id)->first();
        $notification_id = $_POST['notification_id'];

        if( isset($user) ) {

            foreach( $user->readNotifications as $notification )
            {
                if( $notification->id == $notification_id ) {

                    $notification->delete();
                    break;
                    
                }
            }
            
        }

        return redirect()->back();
    }

    public function readNotification()
    {
        $user_id = $_POST['user_id'];
        $user = User::where('id', $user_id)->first();
        $notification_id = $_POST['notification_id'];

        if( isset($user) ) {

            foreach( $user->unreadNotifications as $notification )
            {
                if( $notification->id == $notification_id ) {

                    $notification->markAsRead();
                    break;

                }
            }
            
        }

        return redirect()->back();
    }
}
