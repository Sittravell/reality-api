<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateParser extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->header('Parser-Secret') === config('secret.parser')) {
            return $next($request);
        }

        return responder()->error('authentication_error', 'Invalid Parser-Secret provided.')->respond();
    }
}
