<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePaymentMethodRequest;
use App\Models\Payment;
use App\Services\PaymentMethodService;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * @var PaymentService
     */
    private $paymentService;

    /**
     * BrandController constructor.
     *
     * @param PaymentService $paymentService
     */
    public function __construct(PaymentMethodService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        return view('admin.payment.index', $this->paymentService->index());
    }

    public function edit (Payment $payment)
    {
        return view('admin.payment.edit', $this->paymentService->edit($payment));
    }

    public function update(UpdatePaymentMethodRequest $request, Payment $payment)
    {
        return $this->paymentService->update($request, $payment);
    }
}
