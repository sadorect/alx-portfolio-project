<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;

class UserGrowthChart extends Component
{
    public function getMonthlyGrowth()
    {
        return User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.user-growth-chart', [
            'monthlyGrowth' => $this->getMonthlyGrowth()
        ]);
    }
}
