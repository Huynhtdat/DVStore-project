<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\ShowProductService;
use Illuminate\Http\Request;

class ShowProductController extends Controller
{
    /**
     * @var ShowProductService $showProductService
     */
    private $showProductService;

    /**
     * ProductController constructor.
     *
     * @param ShowProductService $showProductService
     */
    public function __construct(ShowProductService $showProductService)
    {
        $this->showProductService = $showProductService;
    }
    /**
     * Displays home website.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, $slug)
    {
        return view('user.showproduct-category', $this->showProductService->index($request, $slug));
    }
}
