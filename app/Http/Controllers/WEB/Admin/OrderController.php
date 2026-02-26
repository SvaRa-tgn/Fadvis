<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Enum\OrderItemsType;
use App\Http\Controllers\Controller;
use App\Interfaces\IOrderRepository;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        private readonly IOrderRepository $orderRepository,
    ) {}

    /** @return View */
    public function list(): View
    {
        return view(
            view: '/app-page/admin/list',
            data: [
                'orders'   => $this->orderRepository->getAllOrders(),
                'title'    => 'FADVIS: Заказы',
            ],
        );
    }

    public function show(Order $order): View
    {
        return view(
            view: '/app-page/profile/order/order',
            data: [
                'order' => $order,
                'user'  => $order->user,
                'leftHand' => $order->orderItems->firstWhere('prothesis', OrderItemsType::LEFT_PROTHESIS_HAND),
                'rightHand' => $order->orderItems->firstWhere('prothesis', OrderItemsType::RIGHT_PROTHESIS_HAND),
                'leftWrist' => $order->orderItems->firstWhere('prothesis', OrderItemsType::LEFT_PROTHESIS_WRIST),
                'rightWrist' => $order->orderItems->firstWhere('prothesis', OrderItemsType::RIGHT_PROTHESIS_WRIST),
                'title' => 'FADVIS: Заказ № ' . $order->number,
            ],
        );
    }
}
