<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class UpcomingEventsTimeline extends Component
{
    public function getUpcomingEvents($days = 30)
    {
        $today = Carbon::now();
        $maxDate = Carbon::now()->addDays($days);
        
        // Get all celebrants
        $celebrants = auth()->user()->celebrants()->get();
        
        return $celebrants->map(function($celebrant) use ($today, $maxDate) {
            // Calculate next birthday date
            $nextBirthday = null;
            if ($celebrant->birthday) {
                $nextBirthday = Carbon::parse($celebrant->birthday)
                    ->setYear($today->year);
                    
                // If this year's birthday has already passed, use next year's
                if ($nextBirthday->lt($today)) {
                    $nextBirthday->addYear();
                }
            }
            
            // Calculate next anniversary date
            $nextAnniversary = null;
            if ($celebrant->wedding) {
                $nextAnniversary = Carbon::parse($celebrant->wedding)
                    ->setYear($today->year);
                    
                // If this year's anniversary has already passed, use next year's
                if ($nextAnniversary->lt($today)) {
                    $nextAnniversary->addYear();
                }
            }
            
            // Determine which event is coming up first
            $nextEvent = null;
            $eventType = null;
            
            if ($nextBirthday && $nextAnniversary) {
                if ($nextBirthday->lte($nextAnniversary)) {
                    $nextEvent = $nextBirthday;
                    $eventType = 'birthday';
                } else {
                    $nextEvent = $nextAnniversary;
                    $eventType = 'anniversary';
                }
            } elseif ($nextBirthday) {
                $nextEvent = $nextBirthday;
                $eventType = 'birthday';
            } elseif ($nextAnniversary) {
                $nextEvent = $nextAnniversary;
                $eventType = 'anniversary';
            }
            
            return [
                'name' => $celebrant->name,
                'type' => $eventType,
                'date' => $nextEvent,
                'days_until' => $nextEvent ? $today->diffInDays($nextEvent) : null,
                'original_date' => $eventType == 'birthday' ? $celebrant->birthday : $celebrant->wedding
            ];
        })
        ->filter(function ($event) use ($today, $maxDate) {
            // Only include events within our date range
            return $event['date'] && $event['date']->gte($today) && $event['date']->lte($maxDate);
        })
        ->sortBy('date');
    }
    
    public function getEvents($days = 30, $type)   
    {
        $events = $this->getUpcomingEvents($days);
        return $events->groupBy($type)->map->count();
    }

    public function render()
    {
        return view('livewire.upcoming-events-timeline', [
            'events' => $this->getUpcomingEvents()
        ]);
    }
}
