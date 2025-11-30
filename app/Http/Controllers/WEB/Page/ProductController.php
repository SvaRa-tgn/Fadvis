<?php

namespace App\Http\Controllers\WEB\Page;

use App\Enum\CountryMade;
use App\Enum\ManufacturerList;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisSize;
use App\Enum\ProthesisType;
use App\Enum\Status;
use App\Http\Controllers\Controller;
use App\Interfaces\ICategoryRepository;
use App\Interfaces\IColorRepository;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        private readonly IColorRepository $colorRepository,
        private readonly ICategoryRepository $categoryRepository,
    ) {}

    /** @return View */
    public function list(): View
    {
        return view('/app-page/admin/list', ['products' => Product::all()]);
    }

    /** @return View */
    public function create(): View
    {
        return view(
            view: '/app-page/admin/product/create-product',
            data: [
                'colors'        => $this->colorRepository->findByStatus(Status::ACTIVE),
                'sizes'         => ProthesisSize::getAllSizes(),
                'sides'         => ProthesisSide::getAllSides(),
                'countries'     => CountryMade::getAllCountry(),
                'manufacturers' => ManufacturerList::getAllManufacturer(),
                'categories'    => $this->categoryRepository->findByStatus(Status::ACTIVE),
                'types'         => ProthesisType::getAllTypes(),
                'hand_levels'   => ProthesisLevel::getHandItem(),
                'wrist_levels'  => ProthesisLevel::getWristItem(),
            ],
        );
    }

    /**
     * @param Product $product
     * @return View
     */
    public function update(Product $product): View
    {
        return view(
            view: '/app-page/admin/product/update-product',
            data: [
                'product'       => $product,
                'colors'        => $this->colorRepository->findByStatus(Status::ACTIVE),
                'sizes'         => ProthesisSize::getAllSizes(),
                'sides'         => ProthesisSide::getAllSides(),
                'countries'     => CountryMade::getAllCountry(),
                'manufacturers' => ManufacturerList::getAllManufacturer(),
                'categories'    => $this->categoryRepository->findByStatus(Status::ACTIVE),
                'types'         => ProthesisType::getAllTypes(),
                'hand_levels'   => ProthesisLevel::getHandItem(),
                'wrist_levels'  => ProthesisLevel::getWristItem(),
            ],
        );
    }
}
