<?php

namespace App\Http\Controllers\WEB\Profile;

use App\Enum\ProthesisSide;
use App\Enum\ProthesisType;
use App\Http\Controllers\Controller;
use App\Interfaces\IOrderRepository;
use App\Models\Order;
use App\Models\Patient;
use App\Models\User;
use Illuminate\View\View;
use Random\RandomException;

class OrderController extends Controller
{
    public function __construct(
        private readonly IOrderRepository $orderRepository,
    ) {}

    /**
     * @param User $user
     * @return View
     */
    public function list(User $user): View
    {
        return view('/app-page/admin/list', ['user' => $user, 'orders' => $user->orders]);
    }

    /**
     * @param User $user
     * @return View
     */
    public function create(User $user): View
    {
        return view(
            view:'/app-page/profile/order/create-order',
            data: [
                'user'     => $user,
                'patients' => $user->patients,
                'sides'    => ProthesisSide::getAllSides(),
                'types'     => ProthesisType::getAllTypes(),
                ],
        );
    }

    public function createItem(User $user, int $id): View
    {

        return view(
            view:'/app-page/profile/order/create-order-item',
            data: [
                'order' => Order::find($id),
            ],
        );
    }

    /**
     * @param User $user
     * @param Patient $patient
     * @return View
     */
    public function update(User $user, Patient $patient): View
    {
        return view('/app-page/profile/patient/update-patient', ['user' => $user, 'patient' => $patient]);
    }
}
