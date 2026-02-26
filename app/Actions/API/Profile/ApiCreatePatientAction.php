<?php

namespace App\Actions\API\Profile;

use App\DTO\Profile\Patient\CreatePatientDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Exceptions\CreateModelException;
use App\Http\Resources\PatientResource;
use App\Interfaces\IImageRepository;
use App\Interfaces\IPatientImageRepository;
use App\Interfaces\IPatientRepository;
use App\Models\User;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiCreatePatientAction
{
    public function __construct(
        private readonly IPatientRepository $patientRepository,
        private readonly IImageRepository $imageRepository,
        private readonly IPatientImageRepository $patientImageRepository,
    ) {}

    /**
     * @param CreatePatientDTO $dto
     * @param User $user
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(CreatePatientDTO $dto, User $user): JsonResponse
    {
        try {
            DB::beginTransaction();
            $patient = $this->patientRepository->create($dto, $user);

            foreach ($dto->img as $img) {
                if ($img !== null) {
                    $image = $this->imageRepository->create(
                        StorageService::updateImage(StoragePath::IMAGE_STORAGE->value, $img),
                    );

                    $this->patientImageRepository->create($patient, $image);
                }
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
                'data'    => new PatientResource($patient),
                'message' => [
                    'message' => PopUpContent::PATIENT_CREATE_SUCCESS->caption(),
                    'link'    => route('profile.patient.list', $user->id),
                ],
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
