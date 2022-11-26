<?php

namespace App\Http\Middleware\Auth\Api;

use App\Contracts\AbstractClasses\AbsBaseAppMiddleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthCheckingMiddleware extends AbsBaseAppMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $authUser = Auth::user();
        if (!$authUser) {
            return $this->responce->sendError(['reason' => "There is no authorized user"], 'Access denied', 403);
        }

        $request->attributes->add(["user" => $authUser]);
        return $next($request);
    }
}
