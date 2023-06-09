<?php

namespace Kuber\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Kuber\Http\Requests\Admin\LoginRequest;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('kuber::admin.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return to_route(RouteServiceProvider::HOME_ADMIN);
    }
}
