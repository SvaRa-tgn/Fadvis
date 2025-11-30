<?php

namespace App\Actions\API\Profile;

use App\DTO\Admin\Color\UpdateColorDTO;
use App\DTO\Profile\Patient\UpdatePatientDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\StoragePath;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PatientResource;
use App\Interfaces\IColorRepository;
use App\Interfaces\IPatientRepository;
use App\Models\User;
use App\Service\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiUpdatePatientAction
{
    public function __construct(
        private readonly IPatientRepository $patientRepository,
    ) {}

    /** @throws Exception */
    public function execute(UpdatePatientDTO $dto, User $user): JsonResponse
    {
        try {
            DB::beginTransaction();
            $patient = $this->patientRepository->update($dto);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception(
                message: ErrorType::ERROR_INFO->caption(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new PatientResource($patient),
                'message' => [
                    'title'   => PopUpContent::PATIENT_UPDATE_SUCCESS->caption(),
                    'message' => PopUpContent::PATIENT_UPDATE_SUCCESS_INFO->caption(),
                    'route'   => route('profile.patient.list', $user->id),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
