<?php

namespace App\Actions\WEB\RegistrationMasterActions;

use App\Enum\MessengerType;
use App\Enum\UserRoles;
use App\Interfaces\IUserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShowFormAction
{
    public function __construct(
        private readonly IUserRepository $userRepository,
    ) {}

    /** @return RedirectResponse|View */
    public function execute(): RedirectResponse|view
    {
        if ($this->userRepository->findByRole(UserRoles::MASTER)) {
            return redirect(route('main'));
        } else {
            return view(
                view:'/app-page/admin/reg-master/create-admin-form',
                data: [
                    'messengers' => MessengerType::getAllMessenger(),
                    'roles'      => UserRoles::getAllRoles(),
                ],
            );
        }
    }
}
