<?php

namespace App\Actions\API\Admin\Color;

use App\DTO\Admin\Color\UpdateColorDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Exceptions\CreateModelException;
use App\Http\Resources\ColorResource;
use App\Interfaces\IColorRepository;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiUpdateColorAction
{
    public function __construct(
        private readonly IColorRepository $colorRepository,
    ) {}

    /**
     * @param UpdateColorDTO $dto
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(UpdateColorDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();
            $image = [];
            if ($dto->img !== null) {
                StorageService::deleteImage($dto->color->path);

                $image = StorageService::updateImage(StoragePath::COLOR_STORAGE->value, $dto->img);
            }

            $color = $this->colorRepository->update(
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
                'data'    => new ColorResource($color),
                'message' => [
                    'message' => PopUpContent::COLOR_UPDATE_SUCCESS->caption(),
                    'link'    => route('admin.color.list'),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
