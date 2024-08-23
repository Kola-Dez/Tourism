<?php

return [
    App\Providers\AppServiceProvider::class,


    // admin
    App\Providers\admin\Tours\AdminGroupTourServiceProvider::class,
    App\Providers\admin\Tours\AdminPrivateTourServiceProvider::class,
];
