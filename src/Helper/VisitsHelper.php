<?php

namespace Kuber\Helper;

use App\Models\Visits as VisitsModel;
use Kuber\Traits\BounceRate;
use Kuber\Traits\Browser;
use Kuber\Traits\Visits;

class VisitsHelper {
    use Browser, Visits, BounceRate;

    protected $yearCurrent = null;
    
    protected $yearMin = null;

    protected $year = null;

    protected $step = 10;

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

}