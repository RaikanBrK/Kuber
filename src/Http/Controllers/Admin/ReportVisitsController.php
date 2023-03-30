<?php

namespace Kuber\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Kuber\Helper\VisitsHelper;
use App\Http\Controllers\Controller;

class ReportVisitsController extends Controller
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
        $visitsYear = $visitsHelper->getVisitsYear($year);
        
        return view('kuber::admin.reports.visits', compact('visitsYear', 'year', 'yearMin', 'yearCurrent'));
    }    
}
