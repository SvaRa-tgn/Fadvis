<?php

namespace App\Actions\API\Profile\Order;

use App\DTO\Profile\Order\CreateOrderDTO;
use App\DTO\Profile\OrderItems\CreateOrderItemsDTO;
use App\Enum\ErrorType;
use App\Enum\PopUpContent;
use App\Enum\ProthesisSide;
use App\Enum\UserRoles;
use App\Exceptions\CreateModelException;
use App\Http\Resources\OrderResource;
use App\Interfaces\IMakeProthesisService;
use App\Interfaces\IOrderRepository;
use App\Interfaces\IProductRepository;
use App\Interfaces\IUserRepository;
use App\Mail\NewOrderMail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiCreateOrderAction
{
    public function __construct(
        private readonly IOrderRepository      $orderRepository,
        private readonly IProductRepository    $productRepository,
        private readonly IMakeProthesisService $orderItemsService,
        private readonly IUserRepository       $userRepository,
    ) {}

    /**
     * @param CreateOrderDTO $dto
     * @return JsonResponse
     * @throws Throwable
     */
    public function execute(CreateOrderDTO $dto): JsonResponse
    {
        try {
            DB::beginTransaction();

            $leftProducts = $dto->leftProducts
                ? $this->productRepository->findByIds($dto->leftProducts)
                : collect();

            $rightProducts = $dto->rightProducts
                ? $this->productRepository->findByIds($dto->rightProducts)
                : collect();

            if ($leftProducts->isEmpty() && $rightProducts->isEmpty()) {
                throw new Exception(
                    message: 'Товары не переданы',
                );
            }

            $dto->amount = $leftProducts->sum('price') + $rightProducts->sum('price');

            $order = $this->orderRepository->create($dto);

            if (!$leftProducts->isEmpty()) {
                $this->orderItemsService->setRelations(
                    new CreateOrderItemsDTO(
                        order: $order,
                        products: $leftProducts,
                        side: ProthesisSide::LEFT,
                    ),
                );
            }

            if (!$rightProducts->isEmpty()) {
                $this->orderItemsService->setRelations(
                    new CreateOrderItemsDTO(
                        order: $order,
                        products: $rightProducts,
                        side: ProthesisSide::RIGHT,
                    ),
                );
            }

            $master = $this->userRepository->findByRole(UserRoles::MASTER);

            Mail::to($master->email)->send(
                new NewOrderMail($order)
            );

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new CreateModelException(
                message: ErrorType::ERROR_INFO->caption() . $e->getMessage(),
            );
        }

        return new JsonResponse(
            data: [
                'data'    => new OrderResource($order),
                'message' => [
                    'message' => PopUpContent::ORDER_CREATE->caption(),
                    'link'    => route(
                        name: 'profile.order.show',
                        parameters: ['user' => $order->user, 'order' => $order],
                    ),
                ],
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
