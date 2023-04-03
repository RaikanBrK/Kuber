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
}