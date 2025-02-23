<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class TodayAnniversaries extends Component
{
    public function render()
    {
        $celebrants = auth()->user()->celebrants()
            ->whereMonth('wedding', Carbon::now()->month)
            ->whereDay('wedding', Carbon::now()->day)
            ->get();

        return view('livewire.today-anniversaries', [
            'celebrants' => $celebrants
        ]);
    }
}
