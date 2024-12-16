<?php

namespace App\Http\Controllers\Back;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function notification()
    {
        $notifications = Notification::query()->orderBy('id','desc')->get();
        return view('back.pages.notification.index', compact('notifications'));
    }

    public function check()
    {
        $notifications = Notification::query()->where('see',0)->pluck('id')->toArray();
        Notification::query()->whereIn('id', $notifications)->update(['see' => 1]);
        return response()->json([
            'status' => true
        ], 200);
    }
}
