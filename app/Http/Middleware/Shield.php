<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class Shield
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');
            $check = User::find($user->id);
            if ($check) {
                return $next($request);
            } else {
                return redirect('/sign-in');
            }
        } else {
            return redirect('/sign-in');
        }
    }
}