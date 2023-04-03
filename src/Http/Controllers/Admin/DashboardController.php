<?php

namespace Kuber\Http\Controllers\Admin;

use Kuber\Helper\VisitsHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $visitsHelper = new VisitsHelper();

        $visits = $visitsHelper->visitsMonthCurrent();
        $bounceRate = $visitsHelper->bounceRateMountCurrent();
        $visitsYearCurrent = $visitsHelper->getVisitsYearCurrent();
        $browsersQuarterCurrent = $visitsHelper->getBrowsersQuarterCurrent();
        $bounceRateYearCurrent = $visitsHelper->getBounceRateYearCurrent();
        
        return view('kuber::admin.dashboard', compact('visits', 'bounceRate', 'visitsYearCurrent', 'browsersQuarterCurrent', 'bounceRateYearCurrent'));
    }
}
