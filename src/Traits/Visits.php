<?php

namespace Kuber\Traits;

use App\Models\Visits as VisitsModel;

trait Visits
{
    public function visitsMonthCurrent()
    {
        return VisitsModel::whereMonth('created_at', now()->month)->count();
    }

    public function getVisitsYear($year)
    {
        $monthlyVisits = [];

        for ($month = 1; $month <= 12; $month++) {
            $visits = VisitsModel::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $monthlyVisits[$month] = $visits;
        }

        return $monthlyVisits;
    }

    public function getVisitsYearCurrent()
    {
        $year = date('Y');
        return $this->getVisitsYear($year);
    }
}