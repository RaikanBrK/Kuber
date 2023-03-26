<?php

namespace Kuber\Http\Middleware;

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
            'created_at' => now(),
        ];

        DB::table('visits')->insert($visit);

        return $response;
    }
}
