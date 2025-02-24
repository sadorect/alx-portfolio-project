<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use App\Models\Celebrant;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        return view('admin.notifications');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
