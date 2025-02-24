<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Activity;
use Livewire\WithPagination;

class ActivityLog extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.activity-log', [
            'activities' => Activity::with('user')
                ->latest()
                ->paginate(10)
        ]);
    }
}
