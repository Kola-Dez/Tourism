<?php

namespace App\Providers;

use App\Services\Category\CategoryService;
use App\Services\Tours\GroupTourService;
use App\Services\Tours\PrivateTourService;
use Doctrine\Inflector\Rules\Transformation;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Transformation', Transformation::class);

        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService();
        });

        $this->app->singleton(GroupTourService::class, function ($app) {
            return new GroupTourService();
        });

        $this->app->singleton(PrivateTourService::class, function ($app) {
            return new PrivateTourService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->apiRateLimit();

        if (config('app.force_https')) {
            URL::forceScheme('https');
        }
    }

    protected function apiRateLimit(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request));
        });
    }
}
