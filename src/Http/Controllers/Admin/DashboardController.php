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

        $visits = $visitsHelper::visitsMonthCurrent();
        $bounceRate = $visitsHelper::bounceRateMountCurrent();
        $visitsYearCurrent = $visitsHelper::getVisitsYearCurrent();
        $browsersYearCurrent = $visitsHelper->getBrowsersYearCurrent();

        return view('kuber::admin.dashboard', compact('visits', 'bounceRate', 'visitsYearCurrent', 'browsersYearCurrent'));
    }
}
