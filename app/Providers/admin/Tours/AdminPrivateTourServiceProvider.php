<?php

namespace App\Providers\admin\Tours;

use App\Http\Controllers\admin\Tours\Service\AdminPrivateTourService;
use Illuminate\Support\ServiceProvider;

class AdminPrivateTourServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AdminPrivateTourService::class, function () {
            return new AdminPrivateTourService();
        });
    }

    public function boot(): void
    {

    }
}
