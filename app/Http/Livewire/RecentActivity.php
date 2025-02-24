<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use Carbon\Carbon;

class RecentActivity extends Component
{
    public function getActivities()
    {
        return auth()->user()->activities()
            ->latest()
            ->take(10)
            ->get()
            ->map(function($activity) {
                return [
                    'type' => $activity->type,
                    'description' => $activity->description,
                    'created_at' => $activity->created_at,
                    'icon' => $this->getActivityIcon($activity->type),
                    'color' => $this->getActivityColor($activity->type)
                ];
            });
    }

    private function getActivityIcon($type)
    {
        return [
            'wish_sent' => 'fa-envelope',
            'celebrant_added' => 'fa-user-plus',
            'celebrant_updated' => 'fa-user-edit',
            'template_updated' => 'fa-edit',
            'settings_updated' => 'fa-cog',
        ][$type] ?? 'fa-bell';
    }

    private function getActivityColor($type)
    {
        return [
            'wish_sent' => 'text-green-600',
            'celebrant_added' => 'text-blue-600',
            'celebrant_updated' => 'text-yellow-600',
            'template_updated' => 'text-purple-600',
            'settings_updated' => 'text-gray-600',
        ][$type] ?? 'text-brand-600';
    }

    public function render()
    {
        return view('livewire.recent-activity', [
            'activities' => $this->getActivities()
        ]);
    }
}
