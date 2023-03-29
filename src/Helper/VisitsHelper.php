<?php

namespace Kuber\Helper;

use App\Models\Visits;
use Kuber\Traits\Browser;

class VisitsHelper {
    use Browser;

    public function visitsMonthCurrent()
    {
        return Visits::whereMonth('created_at', now()->month)->count();
    }

    public function bounceRateMountCurrent()
    {
        $data = now();
        return $this->bounceRateMount($data->year, $data->month);
    }

    public function bounceRateMount($year, $month, $prefix = '%')
    {
        $visits = Visits::whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
        $exits = Visits::whereYear('created_at', $year)->whereMonth('created_at', $month)->whereNull('referer')->count();

        if ($visits == 0) {
            return 0 . $prefix;
        }

        $bounceRate = ($exits / $visits) * 100;

        return round($bounceRate) . $prefix;
    }

    public function getVisitsYearCurrent()
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

    public function getBrowsersYearCurrent()
    {
        $dataMonth = date('Y-m-01', strtotime('-2 months', strtotime(date('Y-m-d'))));
        $browsers = [];

        foreach($this->__get('allowedBrowsers') as $browser) {
            $countBrowser = Visits::whereDate('created_at', '>=', $dataMonth)->where('browser', $browser)->count();
            $browsers[$browser] = $countBrowser;
        }

        ksort($browsers);

        return $browsers;
    }

    public function getBounceRateYearCurrent()
    {
        $year = now()->year;
        $bounceRateYear = [];

        for($month = 1; $month <= 12; $month++) {
            $bounceRateYear[$month] = $this->bounceRateMount($year, $month, false);
        }

        return $bounceRateYear;
    }
}