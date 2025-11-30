<?php

namespace App\Actions\API\Admin\Category;

use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Http\Resources\CategoryResource;
use App\Interfaces\ICategoryRepository;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiUpdateCategoryAction
{
    public function __construct(
        private readonly ICategoryRepository $categoryRepository,
    ) {}

    /** @throws Exception */
    public function execute(UpdateCategoryDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();
            $image = [];
            if ($dto->img !== null) {
                StorageService::deleteImage($dto->category->path);

                $image = StorageService::updateImage(StoragePath::CATEGORY_STORAGE->value, $dto->img);
            }

            $category = $this->categoryRepository->update(
                dto: $dto,
                image: $image,
            );

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception(
                message: ErrorType::ERROR_INFO->caption(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new CategoryResource($category),
                'message' => [
                    'title'   => PopUpContent::CATEGORY_UPDATE_SUCCESS->caption(),
                    'message' => PopUpContent::CATEGORY_UPDATE_SUCCESS_INFO->caption(),
                    'route'   => route('admin.category.list'),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
