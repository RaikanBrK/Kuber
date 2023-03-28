<?php

namespace Kuber\Http\Middleware;

use Closure;
use App\Models\Visits;
use Kuber\Traits\Browser;

class RecordVisit
{
    use Browser;

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $visit = [
            'ip_address' => $request->ip(),
            'browser' => $this->browser(),
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
