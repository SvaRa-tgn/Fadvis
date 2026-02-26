<?php

namespace App\Actions\API\Admin\Product;

use App\DTO\Admin\Product\CreateProductDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Exceptions\CreateModelException;
use App\Http\Resources\ProductResource;
use App\Interfaces\IImageRepository;
use App\Interfaces\IProductImageRepository;
use App\Interfaces\IProductRepository;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiCreateProductAction
{
    public function __construct(
        private readonly IProductRepository $productRepository,
        private readonly IProductImageRepository $productImageRepository,
        private readonly IImageRepository $imageRepository,
    ) {}

    /**
     * @param CreateProductDTO $dto
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(CreateProductDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository->create(
                dto: $dto,
                image: StorageService::updateImage(StoragePath::PRODUCT_STORAGE->value, $dto->img),
            );

            if ($dto->images !== null) {
                foreach ($dto->images as $image) {
                    $image = $this->imageRepository->create(
                        img: StorageService::updateImage(StoragePath::IMAGE_STORAGE->value, $image),
                    );

                    $this->productImageRepository->create(
                        product: $product,
                        image: $image,
                    );
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new CreateModelException(
                message: ErrorType::ERROR_INFO->caption() . $e->getMessage(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new ProductResource($product),
                'message' => [
                    'message' => PopUpContent::PRODUCT_CREATE_SUCCESS->caption(),
                    'link'    => route('admin.product.list'),
                ],
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
