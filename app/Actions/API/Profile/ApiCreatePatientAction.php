<?php

namespace App\Actions\API\Profile;

use App\DTO\Profile\Patient\CreatePatientDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
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

class ApiCreatePatientAction
{
    public function __construct(
        private readonly IPatientRepository $patientRepository,
        private readonly IImageRepository $imageRepository,
        private readonly IPatientImageRepository $patientImageRepository,
    ) {}

    /** @throws Exception */
    public function execute(CreatePatientDTO $dto, User $user): JsonResponse
    {
        try {
            DB::beginTransaction();
            $patient = $this->patientRepository->create($dto, $user);

            foreach ($dto->img as $img) {
                $image = $this->imageRepository->create(
                    StorageService::updateImage(StoragePath::IMAGE_STORAGE->value, $img),
                );

                $this->patientImageRepository->create($patient, $image);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception(
                message: ErrorType::ERROR_INFO->caption() . $e->getMessage(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new PatientResource($patient),
                'message' => [
                    'title'   => PopUpContent::PATIENT_CREATE_SUCCESS->caption(),
                    'message' => PopUpContent::PATIENT_CREATE_SUCCESS_INFO->caption(),
                    'route'   => route('profile.patient.list', $user->id),
                ],
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
