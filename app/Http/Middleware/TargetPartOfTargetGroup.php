<?php

namespace App\Http\Middleware;

use Closure;
use App\Target;

class TargetPartOfTargetGroup
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
        // Previous one has set an input variable 'targetgroup_id'

        $tgid = $request->input('targetgroup_id');
        $target = Target::findOrFail($request->kohdeID);

        if ($target->targetgroup_id != $tgid) {
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
