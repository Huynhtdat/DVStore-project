<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\OrderHistoryService;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
     /**
     * @var OrderHistoryService
     */
    private $orderHistoryService;

    /**
     * OrderHistoryController constructor.
     *
     * @param OrderHistoryService $orderHistoryService
     */
    public function __construct(OrderHistoryService $orderHistoryService)
    {
        $this->orderHistoryService = $orderHistoryService;
    }

    /**
     * Displays home website.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.order-history', $this->orderHistoryService->index());
    }

    public function show(Order $order)
    {
        return view('user.order-history-detail', $this->orderHistoryService->show($order));
    }

    public function update(Order $order)
    {
        return $this->orderHistoryService->update($order);
    }
}
