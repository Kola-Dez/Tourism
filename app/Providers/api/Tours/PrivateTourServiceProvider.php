<?php

namespace App\Providers\api\Tours;

use App\Http\Controllers\api\V1\Tours\Services\PrivateTourService;
use Illuminate\Support\ServiceProvider;

class PrivateTourServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PrivateTourService::class, function () {
            return new PrivateTourService();
        });
    }

    public function boot(): void
    {

    }
}
