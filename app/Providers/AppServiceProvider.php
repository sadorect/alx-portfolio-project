<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\Admin\ActivityLog;
use App\Http\Livewire\Admin\UserGrowthChart;
use App\Http\Livewire\Admin\UserDetailsModal;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('admin.user-growth-chart', UserGrowthChart::class);
        Livewire::component('admin.activity-log', ActivityLog::class);
        Livewire::component('admin.user-details-modal', UserDetailsModal::class);
    }
}
