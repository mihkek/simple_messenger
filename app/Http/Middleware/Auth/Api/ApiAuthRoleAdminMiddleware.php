<?php

namespace App\Http\Middleware\Auth\Api;

use App\Contracts\AbstractClasses\AbsBaseAppMiddleware;
use App\Contracts\Interfaces\IAuthService;
use App\Enum\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthRoleAdminMiddleware extends AbsBaseAppMiddleware
{
    // protected $authService;

    // public function __construct()
    // {
    //     $this->authService = new AuthService();
    // }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $service = app(IAuthService::class);
        $authUser = Auth::user();
        if (!$service->checkUserHasRole(UserRoleEnum::ADMIN, $authUser->id)) {
            $this->responce->sendError(['reason' => "You are have not required role"], 'Access denied', 403);
        }
        $request->attributes->add(["user_admin" => true]);
        return $next($request);
    }
}
