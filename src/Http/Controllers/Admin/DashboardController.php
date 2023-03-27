<?php

namespace Kuber\Http\Controllers\Admin;

use Kuber\Helper\Visits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $visits = Visits::visitsMonthCurrent();
        $bounceRate = Visits::bounceRateMountCurrent();
        $visitsYearCurrent = Visits::getVisitsYearCurrent();

        return view('kuber::admin.dashboard', compact('visits', 'bounceRate', 'visitsYearCurrent'));
    }
}
