<?php

namespace App\Http\Livewire\Admin;

use App\Models\Activity;
use Livewire\Component;
use Livewire\WithPagination;

class ActivitiesList extends Component
{
    use WithPagination;

    public $search = '';
    public $type = '';

    public function render()
    {
        $activities = Activity::with('user')
            ->when($this->search, function($query) {
                $query->whereHas('user', function($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                });
            })
            ->when($this->type, function($query) {
                $query->where('type', $this->type);
            })
            ->latest()
            ->paginate(15);

        return view('livewire.admin.activities-list', [
            'activities' => $activities
        ]);
    }
}
