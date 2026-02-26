<?php

namespace App\Actions\API\Admin\Image;

use App\DTO\Admin\Image\UpdateImagePatientDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Exceptions\CreateModelException;
use App\Interfaces\IImageRepository;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiUpdateImagePatientAction
{
    public function __construct(
        private readonly IImageRepository $imageRepository,
    ) {}

    /**
     * @param UpdateImagePatientDTO $dto
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(UpdateImagePatientDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();

            StorageService::deleteImage($dto->image->path);

            $this->imageRepository->update(
                image: $dto->image,
                img: StorageService::updateImage(StoragePath::IMAGE_STORAGE->value, $dto->image_patient)
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
                'success' => true,
                'message' => [
                    'message' => PopUpContent::IMAGE_ADD_SUCCESS->caption(),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
