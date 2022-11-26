<?php

namespace App\Http\Middleware\Auth\Panel;

use App\Contracts\Interfaces\IAuthService;
use App\Enum\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRoleAdminMiddleware
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
            return response()->redirectTo('/login'); //
        }
        return $next($request);
    }
}
