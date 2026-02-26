<?php

namespace App\Http\Controllers\WEB\Profile;

use App\Enum\OrderItemsType;
use App\Enum\ProthesisGrip;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisSize;
use App\Enum\ProthesisSystem;
use App\Enum\ProthesisType;
use App\Http\Controllers\Controller;
use App\Interfaces\IProductRepository;
use App\Models\Order;
use App\Models\Patient;
use App\Models\User;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        private readonly IProductRepository $productRepository,
    ) {}

    /**
     * @param User $user
     * @return View
     */
    public function list(User $user): View
    {
        return view(
            view: '/app-page/admin/list',
            data: [
                'user'     => $user,
                'orders'   => $user->orders,
                'patients' => $user->patients,
                'title'    => 'FADVIS: Ваши заказы',
            ],
        );
    }

    /**
     * @param User $user
     * @param Patient $patient
     * @return View
     */
    public function create(User $user, Patient $patient): View
    {
        return view(
            view:'/app-page/profile/order/create-order',
            data: [
                'user'     => $user,
                'patient'  => $patient,
                'sides'    => ProthesisSide::getAllSides(),
                'types'    => ProthesisType::getAllTypes(),
                'sizes'    => ProthesisSize::getAllSizes(),
                'grips'    => ProthesisGrip::getAllGrip(),
                'systems'  => ProthesisSystem::getAllSystems(),
                'products' => $this->productRepository->getActive(),
                'title'    => 'FADVIS: Создать заказ',
            ],
        );
    }

    /**
     * @param User $user
     * @param Order $order
     * @return View
     */
    public function show(User $user, Order $order): View
    {
        return view(
            view: '/app-page/profile/order/order',
            data: [
                'order' => $order,
                'user'  => $user,
                'leftHand' => $order->orderItems->firstWhere('prothesis', OrderItemsType::LEFT_PROTHESIS_HAND),
                'rightHand' => $order->orderItems->firstWhere('prothesis', OrderItemsType::RIGHT_PROTHESIS_HAND),
                'leftWrist' => $order->orderItems->firstWhere('prothesis', OrderItemsType::LEFT_PROTHESIS_WRIST),
                'rightWrist' => $order->orderItems->firstWhere('prothesis', OrderItemsType::RIGHT_PROTHESIS_WRIST),
                'title' => 'FADVIS: Заказ № ' . $order->number,
            ],
        );
    }
}
