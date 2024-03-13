<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateRapidApi extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->header('X-RapidAPI-Proxy-Secret') === config('secret.rapidapi')) {
            return $next($request);
        }

        return responder()->error('authentication_error', 'Invalid X-RapidAPI-Proxy-Secret provided.')->respond();
    }
}
