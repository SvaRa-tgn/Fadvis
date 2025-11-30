<?php

namespace App\Http\Controllers\WEB\RegistrationMaster;

use App\Actions\WEB\RegistrationMasterActions\ShowFormAction;
use App\Enum\UserRoles;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegistrationMasterController extends Controller
{
    public function show(ShowFormAction $action): RedirectResponse|view
    {
        return $action->execute();
    }

    public function filter(): RedirectResponse|Redirector
    {
        if (Auth::user()->role === UserRoles::USER) {
            return redirect('/home');
        } else {
            return redirect(route('showAdmin'));
        }
    }
}
