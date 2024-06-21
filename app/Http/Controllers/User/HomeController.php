<?php

namespace App\Http\Controllers\User;

use App\Models\Color;
use App\Models\Setting;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Services\User\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var HomeService
     */
    private $homeService;

    /**
     * HomeController constructor.
     *
     * @param HomeService $homeService
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }
    /**
     * Displays home website.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.index', $this->homeService->index());
    }
    public function maintenance()
    {
        $setting = Setting::first();
        return view('user.maintenance', [
            'setting' => $setting
        ]);
    }
}
