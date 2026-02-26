<?php

namespace App\Actions\API\Admin\Image;

use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Exceptions\CreateModelException;
use App\Interfaces\IImageRepository;
use App\Interfaces\IProductImageRepository;
use App\Models\Image;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiDeleteImageAction
{
    public function __construct(
        private readonly IProductImageRepository $productImageRepository,
        private readonly IImageRepository $imageRepository,
    ) {}

    /**
     * @param Image $image
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(Image $image): JsonResponse
    {
        try {
            DB::beginTransaction();
            $product = $image->productImage->product;

            $this->productImageRepository->delete($image->productImage);

            StorageService::deleteImage($image->path);

            $this->imageRepository->delete($image);

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
                    'message' => PopUpContent::IMAGE_DELETE_SUCCESS->caption(),
                    'link'    => route('admin.product.update', $product),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
