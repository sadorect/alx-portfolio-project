<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Activity;
use App\Models\Celebrant;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function __construct()
{
   
        if (!auth()->user()->is_admin) {
            return redirect('/');
        }
      
}

    public function dashboard()
    {
        $totalUsers = User::count();
        $newUsers = User::where('created_at', '>=', Carbon::now()->subWeek())->count();
        $totalCelebrations = Celebrant::count();
        $notificationsSent = Activity::where('type', 'wish_sent')->count();
        $activeUsers = User::where('last_login_at', '>=', Carbon::now()->subDay())->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'newUsers',
            'totalCelebrations',
            'notificationsSent',
            'activeUsers'
        ));
    }

    public function users()
    {
        return view('admin.users');
    }

    public function showUser(User $user)
{
    $user->load(['celebrants', 'activities']);
    return view('admin.users.show', compact('user'));
}


    public function activities()
    {
        return view('admin.activities.index');
    }
    public function showActivity(Activity $activity)
{
    return view('admin.activities.show', compact('activity'));
}

    public function notifications()
    {
        return view('admin.notifications.index');
    }

    public function showNotification(Notification $notification)
    {
        return view('admin.notifications.show', compact('notification'));
    }

    public function storeNotification(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'message' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $notification = Notification::create($validated);

        return redirect()->route('admin.notifications')
            ->with('success', 'Notification broadcast successfully');
    }

    public function resolveNotification(Notification $notification)
    {
        $notification->update(['status' => 'resolved']);
        return back()->with('success', 'Notification marked as resolved');
    }
    

    public function settings()
    {
        return view('admin.settings');
    }
}
