<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class TodayBirthdays extends Component
{
    public function render()
    {
        $celebrants = auth()->user()->celebrants()
            ->whereMonth('birthday', Carbon::now()->month)
            ->whereDay('birthday', Carbon::now()->day)
            ->get();

        return view('livewire.today-birthdays', [
            'celebrants' => $celebrants
        ]);
    }
}
