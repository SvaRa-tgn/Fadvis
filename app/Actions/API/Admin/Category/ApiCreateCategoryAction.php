<?php

namespace App\Actions\API\Admin\Category;

use App\DTO\Admin\Category\CreateCategoryDTO;
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

class ApiCreateCategoryAction
{
    public function __construct(
        private readonly ICategoryRepository $categoryRepository,
    ) {}

    /**
     * @param CreateCategoryDTO $dto
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(CreateCategoryDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();
            $category = $this->categoryRepository->create(
                dto: $dto,
                image: StorageService::updateImage(StoragePath::CATEGORY_STORAGE->value, $dto->img)
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
                    'message' => PopUpContent::CATEGORY_CREATE_SUCCESS->caption(),
                    'link'    => route('admin.category.list'),
                ],
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
