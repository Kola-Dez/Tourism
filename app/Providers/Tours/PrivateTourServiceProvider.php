<?php

namespace App\Providers\Tours;

use App\Http\Controllers\api\V1\Tours\Services\Private\PrivateTourService;
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
