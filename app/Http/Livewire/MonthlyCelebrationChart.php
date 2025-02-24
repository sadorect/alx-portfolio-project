<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Celebrant;
use Carbon\Carbon;

class MonthlyCelebrationChart extends Component
{
    public $monthlyData;

    public function mount()
    {
        $this->monthlyData = $this->getMonthlyDistribution();
    }

    private function getMonthlyDistribution()
    {
        $months = collect(range(1, 12))->mapWithKeys(function($month) {
            return [
                Carbon::create()->month($month)->format('F') => [
                    'birthdays' => 0,
                    'anniversaries' => 0
                ]
            ];
        });

        $birthdays = auth()->user()->celebrants()
            ->whereNotNull('birthday')
            ->get()
            ->groupBy(function($celebrant) {
                return Carbon::parse($celebrant->birthday)->format('F');
            });

        $anniversaries = auth()->user()->celebrants()
            ->whereNotNull('wedding')
            ->get()
            ->groupBy(function($celebrant) {
                return Carbon::parse($celebrant->wedding)->format('F');
            });

       

        
        $months = $months->map(function($value, $month) use ($birthdays) {
         if(isset($birthdays[$month])) {
          $value['birthdays'] = $birthdays[$month]->count();
        }
        if(isset($anniversaries[$month])) {
          $value['anniversaries'] = $anniversaries[$month]->count();
      }
      return $value;
      });

  return $months->toArray();

    }

    public function render()
    {
        return view('livewire.monthly-celebration-chart');
    }
}
