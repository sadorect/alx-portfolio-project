<?php

namespace App\Http\Controllers;

use App\Http\Livewire\UpcomingEventsTimeline;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
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
        // If the method only takes days parameter and returns all events
$allUpcomingEvents = (new UpcomingEventsTimeline())->getUpcomingEvents(30);
$totalBirthdays = $allUpcomingEvents->where('type', 'birthday')->count();
$totalAnniversaries = $allUpcomingEvents->where('type', 'anniversary')->count();
$totalCelebrations = $totalAnniversaries + $totalBirthdays;
 $totalCelebrants = Celebrant::all()->count();       
        $notificationsSent = Activity::where('type', 'wish_sent')->count();
        $activeUsers = User::where('last_login_at', '>=', Carbon::now()->subDay())->count();
//dd($totalAnniversaries, $totalBirthdays);
        return view('admin.dashboard', compact(
            'totalUsers',
            'newUsers',
            'totalBirthdays',
            'totalAnniversaries',
            'notificationsSent',
            'activeUsers',
            'totalCelebrations',
            'totalCelebrants'
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
        return view('admin.settings.index');
    }

    public function systemSettings()
{
    return view('admin.settings.system');
}
    public function updateSystemSettings(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string',
            'app_description' => 'required|string',
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'app_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('app_logo')) {
            $validated['app_logo'] = $request->file('app_logo')->store('public/images');
        }

        if ($request->hasFile('app_favicon')) {
            $validated['app_favicon'] = $request->file('app_favicon')->store('public/images');
        }

        Setting::updateOrCreate(['key' => 'app_name'], ['value' => $validated['app_name']]);
        Setting::updateOrCreate(['key' => 'app_description'], ['value' => $validated['app_description']]);
        Setting::updateOrCreate(['key' => 'app_logo'], ['value' => $validated['app_logo']]);
        Setting::updateOrCreate(['key' => 'app_favicon'], ['value' => $validated['app_favicon']]);

        return redirect()->route('admin.settings.system')
            ->with('success', 'System settings updated successfully');
    }

    public function notificationSettings()
{
    return view('admin.settings.notifications');
}
 public function emailSettings()
 {
    return view('admin.settings.email');

}
}