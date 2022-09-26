<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use App\Models\UserNotification;
use App\Models\ReminderNotification;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotificationService
{
    const UNREAD_NOTIFICATIONS  = "1";
    const READ_NOTIFICATIONS    = "0";

    public static function getHeaderNotifications()
    {
        $authUser = Auth()->user();      
        switch ($authUser->role_id) {
            case '1':
                $userType = 'admin';
            break;
            case '2':
                $userType = 'driver';
            break;
            case '3':
                $userType = 'user';
            break;
            
            default:
                $userType = 'user';
            break;
        }

        return $get = UserNotification::where(['recipient_id' => $authUser->id, 'recipient_type' => $userType])->limit(5)->orderBy('id', 'DESC')->get();
    }

    public static function getHeaderNotificationsCount()
    {
        $authUser = Auth()->user();      
        switch ($authUser->role_id) {
            case '1':
                $userType = 'admin';
            break;
            case '2':
                $userType = 'driver';
            break;
            case '3':
                $userType = 'user';
            break;
            
            default:
                $userType = 'user';
            break;
        }

        $authUser   = Auth()->user();
        return $get = UserNotification::where(['recipient_id' => $authUser->id, 'recipient_type' => $userType, 'visibility'=> '1'])->count();
    }

}