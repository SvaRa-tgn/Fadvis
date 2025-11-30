<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Enum\MessengerType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    /** @return View */
    public function show(): View
    {
        return view('/app-page/admin/user/private-admin', ['user' => Auth::user()]);
    }

    /** @return View */
    public function showUpdate(): View
    {
        return view(
            view:'/app-page/admin/update-private-admin',
            data: [
                'user' => Auth::user(),
                'messengers' => MessengerType::getAllMessenger(),
            ],
        );
    }
}
