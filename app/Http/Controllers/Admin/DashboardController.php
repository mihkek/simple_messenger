<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Interfaces\IBaseApiResponseService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return response()->view('admin.dashboard');
    }
}
