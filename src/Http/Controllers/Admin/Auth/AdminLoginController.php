<?php

namespace Kuber\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('kuber::admin.auth.login');
    }
}
