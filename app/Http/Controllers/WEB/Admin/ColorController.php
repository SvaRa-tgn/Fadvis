<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Enum\Status;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\View\View;

class ColorController extends Controller
{
    /** @return View */
    public function list(): View
    {
        return view(
            view: '/app-page/admin/list',
            data: [
                'colors' => Color::all(),
                'title' => 'FADVIS: Админка - Цвета',
            ],
        );
    }

    /** @return View */
    public function create(): View
    {
        return view(
            view: '/app-page/admin/color/create-color',
            data: [
                'title' => 'FADVIS: Админка - Создать цвет',
            ],
        );
    }

    /**
     * @param Color $color
     * @return View
     */
    public function update(Color $color): View
    {
        return view(
            view: '/app-page/admin/color/update-color',
            data:[
                'color' => $color,
                'statuses' => Status::getAllStatus(),
                'title' => 'FADVIS: Админка - Редактировать цвет',
            ],
        );
    }
}
