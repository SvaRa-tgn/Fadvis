<?php

namespace App\Http\Controllers\WEB\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /** @return View */
    public function show(): View
    {
        return view(
            view: '/app-page/admin/user/private-admin',
            data: [
                'user'  => Auth::user(),
                'title' => 'FADVIS: Личный кабинет',
            ],
        );
    }
}
