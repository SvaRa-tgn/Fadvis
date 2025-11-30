<?php

namespace App\Actions\WEB\Page;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ShowCategoryAction
{
    public function execute(Category $category): View
    {
        $sliders = [];

        /** @var Product $product */
        foreach ($category->products as $product) {
            $sliders[] = $product->link;
        }

        return view(
            view: '/app-page/page/category',
            data: [
                'data' => [
                    'category'     => $category,
                    'products'     => $category->products,
                    'descriptions' => explode("\r\n", $category->description_page),
                    'sliders'      => $sliders,
                ],
            ],
        );
    }
}
