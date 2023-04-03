<?php

namespace Kuber\Http\Middleware;

use Closure;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AddSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (File::exists(app_path() . '/Models/Settings.php')) {
            $request->merge(['settings' => Settings::find(1)]);
        }

        return $next($request);
    }
}
