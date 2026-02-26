<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Enum\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /** @return View */
    public function list(): View
    {
        return view(
            view: '/app-page/admin/list',
            data: [
                'categories' => Category::orderBy('id', 'asc')->get(),
                'title' => 'FADVIS: Админка - Категории',
            ]);
    }

    /** @return View */
    public function create(): View
    {
        return view(
            view: '/app-page/admin/category/create-category',
            data: [
                'title' => 'FADVIS: Админка - Создать категорию',
            ],
        );
    }

    /**
     * @param Category $category
     * @return View
     */
    public function update(Category $category): View
    {
        return view('/app-page/admin/category/update-category',
            data: [
                'category' => $category,
                'statuses' => Status::getAllStatus(),
                'title'    => 'FADVIS: Админка - Редактировать категорию',
            ],
        );
    }
}
