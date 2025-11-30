<?php

namespace App\Http\Controllers\WEB\Page;

use App\Actions\WEB\Page\ShowCategoryAction;
use App\Enum\AgePeriod;
use App\Enum\Status;
use App\Http\Controllers\Controller;
use App\Interfaces\ICategoryRepository;
use App\Interfaces\IColorRepository;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        private readonly ICategoryRepository $categoryRepository,
        private readonly IColorRepository $colorRepository,
    ) {}

    /** @return View */
    public function showCatalog(): View
    {
        return view(
            view: '/app-page/page/catalog',
            data: ['categories' => $this->categoryRepository->findByStatus(Status::ACTIVE)]);
    }

    /**
     * @param ShowCategoryAction $action
     * @param Category $category
     * @return View
     */
    public function showCategory(ShowCategoryAction $action, Category $category): View
    {
        return $action->execute($category);
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
                'product' => $product,
                'descriptions' => explode("\r\n", $product->description),
                'colors'   => $this->colorRepository->findByStatus(Status::ACTIVE),
                'images'   => $product->images,
            ]
        );
    }

    /** @return View */
    public function showPriceForm(): View
    {
        return view('/app-page/page/price-form');
    }

    /** @return View */
    public function showProthesisForm(): View
    {
        return view('/app-page/page/prothesis-form', ['ages' => AgePeriod::getAllPeriod()]);
    }
}
