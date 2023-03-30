<?php

namespace Kuber\Helper;

use App\Models\Visits as VisitsModel;
use Kuber\Traits\Browser;
use Kuber\Traits\Visits;

class VisitsHelper {
    use Browser, Visits;

    protected $yearCurrent = null;
    
    protected $yearMin = null;

    protected $year = null;

    protected $step = 5;

    public function runYear($year)
    {
        $this->yearCurrent = now()->year;

        $year = intval($year);
        $this->yearMin = $this->yearCurrent - $this->step;

        if ($year < $this->yearMin || $year > $this->yearCurrent) {
            $year = $this->yearCurrent;
        }

        $this->year = $year;
    }

    public function bounceRateMountCurrent()
    {
        $data = now();
        return $this->bounceRateMount($data->year, $data->month);
    }

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

    public function getBrowsersYearCurrent()
    {
        $dataMonth = date('Y-m-01', strtotime('-2 months', strtotime(date('Y-m-d'))));
        $browsers = [];

        foreach($this->__get('allowedBrowsers') as $browser) {
            $countBrowser = VisitsModel::whereDate('created_at', '>=', $dataMonth)->where('browser', $browser)->count();
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