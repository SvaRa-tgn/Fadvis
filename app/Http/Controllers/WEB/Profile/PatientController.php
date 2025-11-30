<?php

namespace App\Http\Controllers\WEB\Profile;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PatientController extends Controller
{
    /**
     * @param User $user
     * @return View
     */
    public function list(User $user): View
    {
        return view('/app-page/admin/list', ['user' => $user, 'patients' => $user->patients]);
    }

    /** @return View */
    public function create(): View
    {
        return view('/app-page/profile/patient/create-patient', ['user' => Auth::user()]);
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
