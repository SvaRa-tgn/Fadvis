<?php

namespace App\Http\Controllers\WEB\Page;

use App\Enum\AgePeriod;
use App\Enum\Status;
use App\Http\Controllers\Controller;
use App\Interfaces\ICategoryRepository;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        private readonly ICategoryRepository $categoryRepository,
    ) {}

    /** @return View */
    public function showCatalog(): View
    {
        return view(
            view: '/app-page/page/catalog',
            data: [
                'user'       => Auth::check() ? Auth::user() : null,
                'categories' => $this->categoryRepository->findByStatus(Status::ACTIVE),
                'title'      => 'FADVIS: Каталог. Изготовление протезов. Протезы для рук и кистей. Протезы активные и пассивные.',
            ]);
    }

    /**
     * @param Category $category
     * @return View
     */
    public function showCategory(Category $category): View
    {
        return view(
            view: '/app-page/page/category',
            data: [
                'user'         => Auth::check() ? Auth::user() : null,
                'category'     => $category,
                'products'     => $category->products,
                'descriptions' => explode("\r\n", $category->description),
                'title'        => 'FADVIS: ' . $category->name . '. Изготовление протезов. Протезы для рук и кистей. Протезы активные и пассивные.',
            ],
    );
    }

    /**
     * @param Product $product
     * @return View
     */
    public function showProduct(Product $product): View
    {
        return view(
            view: '/app-page/page/product',
            data: [
                'user'         => Auth::check() ? Auth::user() : null,
                'product'      => $product,
                'descriptions' => explode("\r\n", $product->description),
                'images'       => $product->images,
                'title'        => 'FADVIS: '. $product->name .'. Изготовление протезов. Протезы для рук и кистей. Протезы активные и пассивные.',
            ]
        );
    }

    /** @return View */
    public function showPriceForm(): View
    {
        return view(
            view: '/app-page/page/price-form',
            data: [
                'user'  => Auth::check() ? Auth::user() : null,
                'title' => 'FADVIS: Запросить прайс. Изготовление протезов. Протезы для рук и кистей. Протезы активные и пассивные.',
            ]
        );
    }

    /** @return View */
    public function showProthesisForm(): View
    {
        return view(
            view: '/app-page/page/prothesis-form',
            data: [
                'user'  => Auth::check() ? Auth::user() : null,
                'ages'  => AgePeriod::getAllPeriod(),
                'title' => 'FADVIS: Запросить протез. Изготовление протезов. Протезы для рук и кистей. Протезы активные и пассивные.',
            ],
        );
    }
}
