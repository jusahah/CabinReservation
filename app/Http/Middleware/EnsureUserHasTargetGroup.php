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
        $ryhmaID = $request->route('ryhmaID');

        $user = \Auth::user();
        if (!$user->targetgroup_id) {
            return redirect('member/etusivu')->with('error', 'Pääsy estetty. Et ole varausryhmän jäsen. [Virhekoodi: 788]');
        } else if ($ryhmaID != $user->targetgroup_id) {
            \Session::flash('operationfail', 'Pääsy estetty - hakemasi tiedot kuuluvat vieraaseen varausryhmään.');
            return redirect('member/' . $user->targetgroup_id .'/etusivu')->with('error', 'Pääsy estetty. Et ole varausryhmän jäsen. [Virhekoodi: 792]');
            
        }
        // Bind so we can use it in the controllers
        \Input::merge(['targetgroup_id' => $user->targetgroup_id]);

        return $next($request);
    }
}
