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
        return view('/app-page/admin/list', ['categories' => Category::all()]);
    }

    /** @return View */
    public function create(): View
    {
        return view('/app-page/admin/category/create-category');
    }

    /**
     * @param Category $category
     * @return View
     */
    public function update(Category $category): View
    {
        return view('/app-page/admin/category/update-category', [
            'category' => $category,
            'statuses' => Status::getAllStatus(),
        ]);
    }
}
