<?php

namespace App\Actions\API\Profile;

use App\DTO\Profile\Patient\UpdatePatientDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Exceptions\CreateModelException;
use App\Http\Resources\PatientResource;
use App\Interfaces\IPatientRepository;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiUpdatePatientAction
{
    public function __construct(
        private readonly IPatientRepository $patientRepository,
    ) {}

    /**
     * @param UpdatePatientDTO $dto
     * @param User $user
     * @return JsonResponse
     * @throws CreateModelException|Throwable
     */
    public function execute(UpdatePatientDTO $dto, User $user): JsonResponse
    {
        try {
            DB::beginTransaction();
            $patient = $this->patientRepository->update($dto);

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
                    'message' => PopUpContent::PATIENT_UPDATE_SUCCESS->caption(),
                    'link'    => route('profile.patient.list', $user),
                ],
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
