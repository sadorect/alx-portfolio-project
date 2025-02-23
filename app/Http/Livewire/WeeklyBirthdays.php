<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class WeeklyBirthdays extends Component
{
    public function render()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $celebrants = auth()->user()->celebrants()
            ->whereRaw("DATE_FORMAT(birthday, '%m-%d') BETWEEN ? AND ?", [
                $startOfWeek->format('m-d'),
                $endOfWeek->format('m-d')
            ])
            ->orderByRaw("DATE_FORMAT(birthday, '%m-%d')")
            ->get();

        return view('livewire.weekly-birthdays', [
            'celebrants' => $celebrants
        ]);
    }
}
