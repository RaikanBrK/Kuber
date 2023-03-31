<?php

namespace Kuber\Traits;

use \Browser as cbsBrowser;
use Illuminate\Support\Facades\DB;
use App\Models\Visits as VisitsModel;

trait Browser
{
    private $allowedBrowsers = [
        'Chrome',
        'Firefox',
        'Safari',
        'Opera',
        'Edge',
        'Other',
    ];

    public function __get($attr)
    {
        return $this->$attr;
    }

    protected function browser()
    {
        $browser = new cbsBrowser();
        $agent = $browser->getBrowser();

        return in_array($agent, $this->allowedBrowsers) ? $agent : $this->allowedBrowsers['Other'];
    }

    protected function getMonthQuarterly($month)
    {
        if ($month >= 1 && $month <= 3) {
            return [1, 3];
        } else if ($month >= 4 && $month <= 6) {
            return [4, 6];
        } else if ($month >= 7 && $month <= 9) {
            return [7, 9];
        } else if ($month >= 10 && $month <= 12) {
            return [10, 12];
        }
    }

    protected function getStringMonthQuarterly($month)
    {
        return $month < 10 ? '0' . strval($month) : strval($month);
    }

    public function getBrowsersQuarterCurrent()
    {
        $data = now();
        return $this->getBrowsersBetween($data->year, $this->getMonthQuarterly($data->month));
    }

    public function getBrowsersBetween($year, Array $monthsBetween)
    {
        $date1 = date("Y-{$this->getStringMonthQuarterly($monthsBetween[0])}-01");
        $date2 = date("Y-{$this->getStringMonthQuarterly($monthsBetween[1])}-t 23:59:59");

        $monthlyBrowsers = VisitsModel::select(DB::raw('browser'), DB::raw('COUNT(*) as browsers'))
            ->whereYear('created_at', $year)
            ->whereBetween('created_at', [$date1, $date2])
            ->groupBy('browser')
            ->get()
            ->pluck('browsers', 'browser')
            ->toArray()
            ;

        ksort($monthlyBrowsers);
        return $monthlyBrowsers;
    }

    public function getBrowserMonthsFromYear($year, $browser)
    {
        return VisitsModel::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as browsers'))
        ->whereYear('created_at', $year)
        ->where('browser', $browser)
        ->groupBy('month')
        ->get()
        ->pluck('browsers', 'month')
        ->toArray();
    }

    public function getBrowsersYear($year)
    {
        $browsers = [];

        foreach($this->allowedBrowsers as $browser) {
            $browsers[$browser] = $this->getBrowserMonthsFromYear($year, $browser);
        }

        ksort($browsers);

        return $browsers;
    }
}