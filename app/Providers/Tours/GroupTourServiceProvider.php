<?php

namespace App\Providers\Tours;

use App\Http\Controllers\api\V1\Tours\Services\Group\GroupTourService;
use Illuminate\Support\ServiceProvider;

class GroupTourServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GroupTourService::class, function () {
            return new GroupTourService();
        });
    }

    public function boot(): void
    {

    }
}
