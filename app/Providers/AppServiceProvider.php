<?php

namespace App\Providers;

use Flasher\Laravel\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Your registration code here
    }

    /**
     * Get the slug from the current request.
     *
     * @return string|null
     */
    // protected function getSlugFromRequest()
    // {
    //     $fullUrl = url()->current();

    //     // Assuming your slugs are the last part of the URL
    //     $segments = explode('/', $fullUrl);

    //     $slug = end($segments);

    //     // You might want to further sanitize or validate the slug here
    //     return Str::slug($slug);
    // }
}
