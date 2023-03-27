<?php

namespace Kuber\Helper;

use App\Models\Visits as VisitsModel;
use Illuminate\Support\Facades\DB;

class Visits {
    public static function visitsMonthCurrent()
    {
        return VisitsModel::whereMonth('created_at', now()->month)->count();
    }

    public static function bounceRateMountCurrent()
    {
        $visits = VisitsModel::whereMonth('created_at', now()->month)->count();
        $exits = VisitsModel::whereMonth('created_at', now()->month)->whereNull('referer')->count();

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
            $visits = VisitsModel::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $monthlyVisits[$month] = $visits;
        }

        return implode(", ", $monthlyVisits);
    }
}