<?php

namespace App\Http\Controllers\WEB\Profile;

use App\Enum\GenderType;
use App\Enum\MessengerType;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisType;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Monolog\Level;

class PatientController extends Controller
{
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
                'patients' => $user->patients,
                'title'    => 'FADVIS: Пациенты'
            ],
        );
    }

    /**
     * @param User $user
     * @return View
     */
    public function create(User $user): View
    {
        return view(
            view: '/app-page/profile/patient/create-patient',
            data: [
                'user'       => $user,
                'genders'    => GenderType::getAllGender(),
                'messengers' => MessengerType::getAllMessenger(),
                'types'      => ProthesisType::getAllTypes(),
                'hands'      => ProthesisLevel::getHandItem(),
                'wrists'     => ProthesisLevel::getWristItem(),
                'title'      => 'FADVIS: Создать пациента'
            ]);
    }

    /**
     * @param User $user
     * @param Patient $patient
     * @return View
     */
    public function update(User $user, Patient $patient): View
    {
        return view(view: '/app-page/profile/patient/update-patient',
            data: [
                'user'       => $user,
                'patient'    => $patient,
                'genders'    => GenderType::getAllGender(),
                'messengers' => MessengerType::getAllMessenger(),
                'types'      => ProthesisType::getAllTypes(),
                'hands'      => ProthesisLevel::getHandItem(),
                'wrists'     => ProthesisLevel::getWristItem(),
                'title'      => 'FADVIS: Редактировать ' . $patient->surname . ' ' . $patient->name. ' ' . $patient->patronymic
            ]);
    }
}
