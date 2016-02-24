<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsActivated
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
   
        // We dont yet have user but we do have email
        // and as email is unique among users we fetch with it



        $email = $request->input('email');


        $user = \App\User::where('email', $email)->firstOrFail();
        $group = $user->targetgroup;

        if (!$group) return response('Ryhmää ei liitetty käyttäjätunnukseesi - ota yhteys ylläpitoon', 403);
        $adminID = $group->user_id;

        $admin = \App\User::findOrFail($adminID);
        
        if (!$user->isActivated) {
            return view('eiaktivoitu')->with('admin', $admin);
        }


        return $next($request);
    }
}
