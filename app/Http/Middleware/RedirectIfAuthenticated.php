<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated as Middleware;

class RedirectIfAuthenticated extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            return route('dashboard'); // atau 'home' jika tidak pakai dashboard
        }

        return null;
    }
}
