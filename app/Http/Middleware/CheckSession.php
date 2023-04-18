<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
{
    if (!$request->session()->has('last_activity')) {
        $request->session()->put('last_activity', time());
    } elseif (time() - $request->session()->get('last_activity') > config('session.lifetime') * 60) {
        $request->session()->put('url.intended', url()->full());
        return redirect('/login');
    }

    $request->session()->put('last_activity', time());

    return $next($request);
}


}
