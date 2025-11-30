<?php

namespace App\Actions\API\Admin\Image;

use App\DTO\Admin\Image\AddImageDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Interfaces\IImageRepository;
use App\Interfaces\IProductImageRepository;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiAddImageAction
{
    public function __construct(
        private readonly IProductImageRepository $productImageRepository,
        private readonly IImageRepository $imageRepository,
    ) {}

    /** @throws Exception */
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
