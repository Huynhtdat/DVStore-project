<?php

namespace App\Http\Controllers\User;

use App\Models\Color;
use App\Models\Setting;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Services\User\HomeService;
use App\Repository\Eloquent\CartRepository;
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

     /**
     * @var CartRepository
     */
    private $cartRepository;
    public function __construct(HomeService $homeService, CartRepository $cartrepository)
    {
        $this->homeService = $homeService;
        $this->cartRepository = $cartrepository;
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
        $cart = $this->cartRepository->getCart();
        return view('user.maintenance', [
            'setting' => $setting,
            'cart' => $cart
        ]);
    }
    public function introduction()
    {
        $setting = Setting::first();
        return view('user.introduction', ['setting' => $setting]);
    }
}
