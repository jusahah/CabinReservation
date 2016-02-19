<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserHasTargetGroup
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

        $user = \Auth::user();
        if (!$user->targetgroup_id) {
            return redirect('member/home')->with('error', 'Sinun täytyy olla varausryhmän jäsen.');
        }
        \Input::merge(['targetgroup_id' => $user->targetgroup_id]);
        return $next($request);
    }
}
