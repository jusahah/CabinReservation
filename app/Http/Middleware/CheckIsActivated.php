<?php

namespace App\Http\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
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

        try {
            $user = \App\User::where('email', $email)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return back()->withErrors(array('message' => 'Sähköpostiosoitetta ei löytynyt'));
        }
        
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
