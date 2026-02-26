<?php

namespace App\Actions\API\Admin\Category;

use App\DTO\Admin\Category\UpdateCategoryDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Exceptions\CreateModelException;
use App\Http\Resources\CategoryResource;
use App\Interfaces\ICategoryRepository;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiUpdateCategoryAction
{
    public function __construct(
        private readonly ICategoryRepository $categoryRepository,
    ) {}

    /**
     * @param UpdateCategoryDTO $dto
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
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
            throw new CreateModelException(
                message: ErrorType::ERROR_INFO->caption(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new CategoryResource($category),
                'message' => [
                    'message' => PopUpContent::CATEGORY_UPDATE_SUCCESS->caption(),
                    'link'    => route('admin.category.update', $category),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
