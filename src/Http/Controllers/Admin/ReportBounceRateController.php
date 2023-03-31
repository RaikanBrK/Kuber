<?php

namespace Kuber\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kuber\Helper\VisitsHelper;
use App\Http\Controllers\Controller;

class ReportBounceRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $visitsHelper = new VisitsHelper();

        $visitsHelper->runYear($request->year);

        $year = $visitsHelper->year;
        $yearCurrent = $visitsHelper->yearCurrent;
        $yearMin = $visitsHelper->yearMin - 1;
        $bounceRateYear = $visitsHelper->getBounceRateYear($year);
        
        return view('kuber::admin.reports.bounce-rate', compact('bounceRateYear', 'year', 'yearMin', 'yearCurrent'));
    }
}
