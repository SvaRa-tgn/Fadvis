<?php

namespace App\Actions;

use App\Enum\Status;
use App\Interfaces\ICategoryRepository;
use App\Models\Category;
use Illuminate\View\View;

class IndexAction
{
    public function __construct(
        private readonly ICategoryRepository $categoryRepository,
    ) {}

    /**
     * @return View
     */
    public function execute(): View
    {
        $catalogs = [];
        /** @var Category $category */
        foreach ($this->categoryRepository->findByStatus(Status::ACTIVE) as $category) {

            $catalogs [] = [
                'id'           => $category->id,
                'name'         => $category->name,
                'link'         => $category->link,
                'descriptions' => explode("\r\n", $category->description_index),
            ];
        }

        return view('/app-page/index/index-content', ['catalogs' => $catalogs]);
    }
}
