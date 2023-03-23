<?php

namespace Kuber\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        dd($request->settings);
        // return view('kuber::admin.site.index');
    }

    public function store(Request $request)
    {
       
    }
}
