<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\HomeService;
use App\Http\Services\User\ProductDetailService;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    /**
     * @var ProductDetailService
     */
    private $productDetailService;

    /**
     * ProductDetailService constructor.
     *
     * @param ProductDetailController $productDetailService
     */
    public function __construct(ProductDetailService $productDetailService)
    {
        $this->productDetailService = $productDetailService;
    }
    /**
     * Displays home website.
     *
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('user.product-detail', $this->productDetailService->show($product));
    }
}
