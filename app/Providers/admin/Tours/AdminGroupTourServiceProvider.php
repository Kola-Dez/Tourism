<?php

namespace App\Providers\admin\Tours;

use App\Http\Controllers\admin\Tours\Service\AdminGroupTourService;
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
