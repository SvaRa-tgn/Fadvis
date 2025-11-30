<?php

namespace App\Actions\API\Admin\Product;

use App\DTO\Admin\Product\UpdateProductDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Http\Resources\ProductResource;
use App\Interfaces\IProductRepository;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiUpdateProductAction
{
    public function __construct(
        private readonly IProductRepository $productRepository,
    ) {}

    /** @throws Exception */
    public function execute(UpdateProductDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();
            $image = [];
            if ($dto->img !== null) {
                StorageService::deleteImage($dto->product->path);

                $image = StorageService::updateImage(StoragePath::COLOR_STORAGE->value, $dto->img);
            }

            $product = $this->productRepository->update(
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
                'data'    => new ProductResource($product),
                'message' => [
                    'title'   => PopUpContent::PRODUCT_UPDATE_SUCCESS->caption(),
                    'message' => PopUpContent::PRODUCT_UPDATE_SUCCESS_INFO->caption(),
                    'route'   => route('admin.product.list'),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
