<?php

namespace App\Http\Middleware;

use App\Carving;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthorizeCarvingChangeMiddleware
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
        /** @var Carving $carving */
        $carving = $request->route('carving');

        if(is_int($carving) || is_string($carving)) {
            $carving = Carving::where('id', $carving)->first();
        }


        $authenticatedUserID = Auth::user()->id;
        $carvingUserID       = $carving->user->id;
        $isAdmin             = Auth::user()->is_admin;

        if ( $authenticatedUserID !== $carvingUserID && !$isAdmin) {
            return redirect('home');
        }

        return $next($request);
    }
}
