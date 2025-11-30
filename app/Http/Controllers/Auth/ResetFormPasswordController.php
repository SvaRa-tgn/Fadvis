<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ResetFormPasswordController
{
    /**
     * @param Request $request
     * @return View
     */
    public function resetForm(Request $request): View
    {
        return view('app-page.page.new-password', ['request' => $request]);
    }
}
