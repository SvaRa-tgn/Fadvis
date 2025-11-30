<?php

namespace App\Actions\API\Admin\Image;

use App\DTO\Admin\Product\UpdateProductDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Http\Resources\ProductResource;
use App\Interfaces\IImageRepository;
use App\Interfaces\IProductImageRepository;
use App\Interfaces\IProductRepository;
use App\Models\Image;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiDeleteImageAction
{
    public function __construct(
        private readonly IProductImageRepository $productImageRepository,
        private readonly IImageRepository $imageRepository,
    ) {}

    /** @throws Exception */
    public function execute(Image $image): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->productImageRepository->delete($image->productImage);

            StorageService::deleteImage($image->path);

            $this->imageRepository->delete($image);

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
                    'title'   => PopUpContent::IMAGE_DELETE_SUCCESS->caption(),
                    'message' => PopUpContent::IMAGE_DELETE_SUCCESS_INFO->caption(),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
