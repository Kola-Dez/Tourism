<?php

return [
    App\Providers\AppServiceProvider::class,

    // api Service Provider
    App\Providers\api\Category\CategoryServiceProvider::class,
    App\Providers\api\Tours\GroupTourServiceProvider::class,
    App\Providers\api\Tours\PrivateTourServiceProvider::class,

    // admon
    App\Providers\admin\Tours\AdminGroupTourServiceProvider::class,
    App\Providers\admin\Tours\AdminPrivateTourServiceProvider::class,
];
