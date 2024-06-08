<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\DashboardService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * @var DashboardService
     */
    private $dashboardService;

    /**
     * BrandController constructor.
     *
     * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    /**
     * Displays a dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // dd(Auth::check());
        return view('admin.dashboard.index', $this->dashboardService->index());
    }
}
