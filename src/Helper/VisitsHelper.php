<?php

namespace Kuber\Helper;

use App\Models\Visits;
use Illuminate\Support\Facades\DB;

class VisitsHelper {
    public static function visitsMonthCurrent()
    {
        return Visits::whereMonth('created_at', now()->month)->count();
    }

    public static function bounceRateMountCurrent()
    {
        $visits = Visits::whereMonth('created_at', now()->month)->count();
        $exits = Visits::whereMonth('created_at', now()->month)->whereNull('referer')->count();

        if ($visits == 0) {
            return 0 . '%';
        }

        $bounceRate = ($exits / $visits) * 100;

        return round($bounceRate) . '%';
    }

    public static function getVisitsYearCurrent()
    {
        $year = date('Y');
        $monthlyVisits = [];

        for ($month = 1; $month <= 12; $month++) {
            $visits = Visits::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $monthlyVisits[$month] = $visits;
        }

        return $monthlyVisits;
    }
}