<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class UpcomingEventsTimeline extends Component
{
    public function getUpcomingEvents()
    {
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays(7);

        return auth()->user()->celebrants()
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereRaw("DATE_FORMAT(birthday, '%m-%d') BETWEEN ? AND ?", [
                    $startDate->format('m-d'),
                    $endDate->format('m-d')
                ])
                ->orWhereRaw("DATE_FORMAT(wedding, '%m-%d') BETWEEN ? AND ?", [
                    $startDate->format('m-d'),
                    $endDate->format('m-d')
                ]);
            })
            ->get()
            ->map(function($celebrant) {
                return [
                    'name' => $celebrant->name,
                    'type' => $celebrant->birthday ? 'birthday' : 'anniversary',
                    'date' => $celebrant->birthday ?? $celebrant->wedding
                ];
            })
            ->sortBy('date');
    }

    public function render()
    {
        return view('livewire.upcoming-events-timeline', [
            'events' => $this->getUpcomingEvents()
        ]);
    }
}
