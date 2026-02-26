<?php

namespace App\Actions\API\Admin\Color;

use App\DTO\Admin\Color\CreateColorDTO;
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

class ApiCreateColorAction
{
    public function __construct(
        private readonly IColorRepository $colorRepository,
    ) {}

    /**
     * @param CreateColorDTO $dto
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(CreateColorDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();
            $color = $this->colorRepository->create(
                dto: $dto,
                image: StorageService::updateImage(StoragePath::COLOR_STORAGE->value, $dto->img)
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
                    'message' => PopUpContent::COLOR_CREATE_SUCCESS->caption(),
                    'link'    => route('admin.color.list'),
                ],
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
