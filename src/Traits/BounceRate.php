<?php

namespace Kuber\Traits;

use App\Models\Visits as VisitsModel;

trait BounceRate
{
    public function bounceRateMount($year, $month, $prefix = '%')
    {
        $visits = VisitsModel::whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
        $exits = VisitsModel::whereYear('created_at', $year)->whereMonth('created_at', $month)->whereNull('referer')->count();

        if ($visits == 0) {
            return 0 . $prefix;
        }

        $bounceRate = ($exits / $visits) * 100;

        return round($bounceRate) . $prefix;
    }

    public function getBounceRateYear($year)
    {
        $bounceRateYear = [];

        for($month = 1; $month <= 12; $month++) {
            $bounceRateYear[$month] = $this->bounceRateMount($year, $month, false);
        }

        return $bounceRateYear;
    }

    public function bounceRateMountCurrent()
    {
        $data = now();
        return $this->bounceRateMount($data->year, $data->month);
    }

    public function getBounceRateYearCurrent()
    {
        $year = now()->year;
        return $this->getBounceRateYear($year);
    }
}