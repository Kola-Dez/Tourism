<?php

namespace App\Providers\admin\Tours;

use App\Services\admin\Tours\AdminGroupTourService;
use Illuminate\Support\ServiceProvider;

class AdminGroupTourServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AdminGroupTourService::class, function () {
            return new AdminGroupTourService();
        });
    }

    public function boot(): void
    {

    }
}
