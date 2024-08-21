<?php

return [
    App\Providers\AppServiceProvider::class,

    // api Service Provider
    App\Providers\Category\CategoryServiceProvider::class,
    App\Providers\Tours\GroupTourServiceProvider::class,
    App\Providers\Tours\PrivateTourServiceProvider::class,
];
