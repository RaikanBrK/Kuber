<?php

namespace Kuber\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index(Request $request)
    {
        return view('kuber::admin.auth.reset-password', ['email' => $request->email]);
    }
}
