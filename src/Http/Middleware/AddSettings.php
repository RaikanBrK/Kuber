<?php

namespace Kuber\Http\Middleware;

use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;

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
        $request->merge(['settings' => Settings::find(1)]);

        return $next($request);
    }
}
