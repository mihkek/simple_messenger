<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Interfaces\IAuthService;
use App\Http\Controllers\Controller;
use App\Library\IApiResponse;
use App\Services\ApiResponceService;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signin(Request $request, IAuthService $service)
    {
        return $service->signin($request->email, $request->password);
    }
    public function signup(Request $request, IAuthService $service)
    {
        return $service->signup($request->all());
    }
}
