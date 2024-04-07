<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LastActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = $request->user();
        // if ($user) {
        //     $user->forceFill([
        //         'last_activity' => now(),
        //         // 'last_activity' => Carbon::now(),
        //     ])->save();
        // }

        // other way
        $user = Auth::user();
        if ($user) {
            $user->forceFill([
                'last_activity' => now(),
            ])->save();
        }

        return $next($request);
    }
}