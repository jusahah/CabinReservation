<?php

namespace App\Http\Middleware;

use Closure;
use App\Targetgroup;

class IsTargetGroupAdmin
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
         $tgid = $user->targetgroup_id;

         $group = Targetgroup::findOrFail($tgid);

         if (!$group->user_id === \Auth::id()) {
            return redirect('member/home')->with('error', 'Sinun täytyy olla varausryhmän admin suorittaaksesi toiminnon!');

         }

         // He is admin - who knew...
         return $next($request);


    }
}
