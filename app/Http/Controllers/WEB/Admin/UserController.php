<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Enum\MessengerType;
use App\Enum\Status;
use App\Enum\UserRoles;
use App\Http\Controllers\Controller;
use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private readonly IUserRepository $userRepository,
    ) {}

    /** @return View */
    public function list(): View
    {
        return view('/app-page/admin/list', ['users' => $this->userRepository->findByRoleUser()]);
    }

    /** @return View */
    public function create(): View
    {
        return view(
            view: '/app-page/admin/user/create-user-form',
            data: [
                'messengers' => MessengerType::getAllMessenger(),
                'roles' => UserRoles::getAllRoles(),
            ],
        );
    }

    /**
     * @param User $user
     * @return View
     */
    public function update(User $user): View
    {
        return view(
            view: '/app-page/admin/user/update-user-form',
            data: [
                'user' => $user,
                'messengers' => MessengerType::getAllMessenger(),
                'roles' => UserRoles::getAllRoles(),
                'statuses' => Status::getAllStatus(),
            ],
        );
    }
}
