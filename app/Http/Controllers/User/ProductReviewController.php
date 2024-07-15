<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\ProductReviewRequest;
use App\Models\Product;
use App\Http\Services\User\ProductReviewService;
use App\Http\Controllers\Controller;

class ProductReviewController extends Controller
{
    /**
     * @var ProductReviewService
     */
    private $productReviewService;

    /**
     * ProductReviewController constructor.
     *
     * @param ProductReviewService $productReviewService
     */
    public function __construct(ProductReviewService $productReviewService)
    {
        $this->productReviewService = $productReviewService;
    }

    public function store(ProductReviewRequest $request, Product $product)
    {
        return $this->productReviewService->store($request, $product);
    }
}
