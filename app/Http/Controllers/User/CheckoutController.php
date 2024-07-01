<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\CheckOutRequest;
use App\Http\Services\User\CheckOutService;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class CheckoutController extends Controller
{
    /**
     * @var CheckOutService
     */
    private $checkOutService;

    /**
     * CheckOutController constructor.
     *
     * @param CheckOutService $checkOutService
     */
    public function __construct(CheckOutService $checkOutService)
    {
        $this->checkOutService = $checkOutService;
    }
    /**
     * hiển thị trang thanh toán
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.checkout', $this->checkOutService->index());
    }

    public function store(CheckOutRequest $request)
    {
        // check payment method is momo
        if ($request->payment_method == 2) {
            return $this->checkOutService->paymentMomo();
        }

        // check payment method is VNPAY
        if ($request->payment_method == 3) {
            return $this->checkOutService->paymentVNPAY();
        }

        return $this->checkOutService->store($request);
    }

    public function callbackMomo(Request $request)
    {
        return $this->checkOutService->callbackMomo($request);
    }

    public function callbackVNPay(Request $request)
    {
        return $this->checkOutService->callbackVNPay($request);
    }
}
