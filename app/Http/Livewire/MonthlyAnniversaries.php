<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class MonthlyAnniversaries extends Component
{
    public function render()
    {
        $celebrants = auth()->user()->celebrants()
            ->whereMonth('wedding', Carbon::now()->month)
            ->orderByRaw("DAY(wedding)")
            ->get();

        return view('livewire.monthly-anniversaries', [
            'celebrants' => $celebrants
        ]);
    }
}
