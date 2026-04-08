<?php
// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Custom Tailwind pagination
        Paginator::defaultView('vendor.pagination.tailwind');
        Paginator::defaultSimpleView('vendor.pagination.simple-tailwind');
        View::composer('*', function ($view) {
            // Cache ringan: hanya 1x query per request
            static $settings = null;
            if ($settings === null) {
                $settings = SiteSetting::instance();
            }
            $view->with('siteSettings', $settings);
        });
    }
}
