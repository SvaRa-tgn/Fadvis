<?php

namespace App\Actions\API\Profile\Order;

use App\DTO\Profile\Order\CreateOrderDTO;
use App\Enum\ErrorType;
use App\Http\Resources\OrderResource;
use App\Interfaces\IOrderRepository;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiCreateOrderAction
{
    public function __construct(
        private readonly IOrderRepository $orderRepository,
    ) {}

    /** @throws Exception */
    public function execute(CreateOrderDTO $dto, User $user): JsonResponse
    {
        try {
            DB::beginTransaction();
            $order = $this->orderRepository->create($dto, $user);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception(
                message: ErrorType::ERROR_INFO->caption() . $e->getMessage(),
            );
        }

        return new JsonResponse(
            data: [
                'data' => new OrderResource($order),
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
