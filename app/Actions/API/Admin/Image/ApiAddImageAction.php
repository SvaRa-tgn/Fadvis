<?php

namespace App\Actions\API\Admin\Image;

use App\DTO\Admin\Image\AddImageDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Exceptions\CreateModelException;
use App\Interfaces\IImageRepository;
use App\Interfaces\IProductImageRepository;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiAddImageAction
{
    public function __construct(
        private readonly IProductImageRepository $productImageRepository,
        private readonly IImageRepository $imageRepository,
    ) {}

    /**
     * @param AddImageDTO $dto
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(AddImageDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();

            foreach ($dto->images as $img) {
                $imagePath = StorageService::updateImage(StoragePath::IMAGE_STORAGE->value, $img);

                $image = $this->imageRepository->create($imagePath);

                $this->productImageRepository->create($dto->product, $image);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new CreateModelException(
                message: ErrorType::ERROR_INFO->caption(),
            );

        }
        return new JsonResponse(
            data: [
                'message' => [
                    'message' => PopUpContent::IMAGE_ADD_SUCCESS->caption(),
                    'link'    => route('admin.product.update', $dto->product),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
