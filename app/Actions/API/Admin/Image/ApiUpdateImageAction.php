<?php

namespace App\Actions\API\Admin\Image;

use App\DTO\Admin\Image\UpdateImageProductDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Interfaces\IImageRepository;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiUpdateImageAction
{
    public function __construct(
        private readonly IImageRepository $imageRepository,
    ) {}

    /** @throws Exception */
    public function execute(UpdateImageProductDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();

            StorageService::deleteImage($dto->image->path);

            $this->imageRepository->update(
                image: $dto->image,
                img: StorageService::updateImage(StoragePath::IMAGE_STORAGE->value, $dto->image_product)
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
                'message' => [
                    'title'   => PopUpContent::IMAGE_ADD_SUCCESS->caption(),
                    'message' => PopUpContent::IMAGE_ADD_SUCCESS_INFO->caption(),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
