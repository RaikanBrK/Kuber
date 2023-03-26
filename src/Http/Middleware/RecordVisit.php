<?php

namespace Kuber\Http\Middleware;

use App\Models\Visits;
use Closure;
use Illuminate\Support\Facades\DB;

class RecordVisit
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $visit = [
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'path' => $request->path(),
            'referer' => $request->header('Referer'),
        ];

        $lastVisit = Visits::where($visit)->orderBy('created_at', 'desc')->get()->first()->created_at ?? false;
        $data = now();

        if ($data->diffInMinutes($lastVisit) >= 5 || $lastVisit == false) {
            Visits::create($visit);
        }

        return $response;
    }
}
