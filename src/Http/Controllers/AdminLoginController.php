<?php

namespace Kuber\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function index()
    {
        return 'Index Admin Kuber';
    }
}
