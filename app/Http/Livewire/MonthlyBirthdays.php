<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class MonthlyBirthdays extends Component
{
    public function render()
    {
        $celebrants = auth()->user()->celebrants()
            ->whereMonth('birthday', Carbon::now()->month)
            ->orderByRaw("DAY(birthday)")
            ->get();

        return view('livewire.monthly-birthdays', [
            'celebrants' => $celebrants
        ]);
    }
}
