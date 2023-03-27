<?php

namespace Kuber\Http\Controllers\Admin;

use Kuber\Helper\VisitsHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $visits = VisitsHelper::visitsMonthCurrent();
        $bounceRate = VisitsHelper::bounceRateMountCurrent();
        $visitsYearCurrent = VisitsHelper::getVisitsYearCurrent();

        return view('kuber::admin.dashboard', compact('visits', 'bounceRate', 'visitsYearCurrent'));
    }
}
