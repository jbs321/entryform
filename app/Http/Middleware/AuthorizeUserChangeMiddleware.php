<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthorizeUserChangeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User $carving */
        $user = $request->route('user');

        $authenticatedUserID   = Auth::user()->id;
        $userRequestedChangeID = $user->id;

        $isAdmin             = Auth::user()->is_admin;

        if ( $authenticatedUserID !== $userRequestedChangeID && !$isAdmin) {
            return redirect('home');
        }

        return $next($request);
    }
}
