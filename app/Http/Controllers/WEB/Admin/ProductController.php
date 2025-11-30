<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Actions\WEB\Admin\Category\CategoryListAction;
use App\Actions\WEB\Admin\Category\CreateCategoryAction;
use App\Actions\WEB\Admin\Category\UpdateCategoryAction;
use App\Actions\WEB\Admin\Product\ProductListAction;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function list(ProductListAction $action): View
    {
        return $action->execute();
    }

    public function create(CreateCategoryAction $action): View
    {
        return $action->execute();
    }

    public function update(UpdateCategoryAction $action, Category $category): View
    {
        return $action->execute($category);
    }
}
