<?php

namespace App\Providers\Category;

use App\Http\Controllers\api\V1\Category\Services\CategoryService;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CategoryService::class, function () {
            return new CategoryService();
        });
    }

    public function boot(): void
    {

    }
}
