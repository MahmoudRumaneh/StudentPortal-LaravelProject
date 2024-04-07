<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Other code...

    protected $routeMiddleware = [
        // Other middleware...
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'redirect.authenticated' => \App\Http\Middleware\RedirectAuthenticatedUsers::class,
    ];


    // Other code...
}
