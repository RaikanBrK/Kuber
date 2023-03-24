<?php

namespace Kuber\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kuber\Http\Requests\SettingsUpdateRequest;

class LogoAndFaviconController extends Controller
{
    public function index(Request $request)
    {
        return view('kuber::admin.assets.index', ["settings" => $request->settings]);
    }

    public function store(Request $request)
    {
    }
}
