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
        return view('/app-page/admin/user/private-admin', ['user' => Auth::user()]);
    }
}
