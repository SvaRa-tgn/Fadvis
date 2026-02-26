<?php

namespace App\Service;

use App\DTO\Profile\Item\CreateItemDTO;
use App\DTO\Profile\OrderItems\CreateOrderItemsDTO;
use App\Enum\OrderItemsType;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisType;
use App\Interfaces\IItemRepository;
use App\Interfaces\IMakeProthesisService;
use App\Interfaces\IOrderItemsRepository;
use App\Models\Product;
use Exception;

class MakeProthesisService implements IMakeProthesisService
{
    public function __construct(
        private readonly IOrderItemsRepository $orderItemsRepository,
        private readonly IItemRepository $itemsRepository,
    ) {}

    /**
     * @param CreateOrderItemsDTO $dto
     * @return bool
     * @throws Exception
     */
    public function setRelations(CreateOrderItemsDTO $dto): bool
    {
        $amount = 0;
        $items = [];
        $type = null;

        foreach ($dto->products as $product) {
            /** @var Product $product */
            if (in_array($product->level, ProthesisLevel::getHandItem(), true)) {
                $amount = $amount + $product->price;
                $items[] = $product;
                $type = $product->type;
            }

            if (in_array($product->level, ProthesisLevel::getWristItem(), true)) {
                $amount = $amount + $product->price;
                $items[] = $product;
                $type = $product->type;
            }
        }

        if (!empty($items)) {
            $dto->orderItemsType = $type === ProthesisType::PROTHESIS_HAND
                ? $this->getHandSide($dto->side)
                : $this->getWristSide($dto->side);

            $dto->amount = $amount;
            $dto->items = $items;

            if ($this->createRelations($dto)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param ProthesisSide $side
     * @return OrderItemsType
     */
    private function getHandSide(ProthesisSide $side): OrderItemsType
    {
        return $side === ProthesisSide::LEFT
            ? OrderItemsType::LEFT_PROTHESIS_HAND
            : OrderItemsType::RIGHT_PROTHESIS_HAND;
    }

    /**
     * @param ProthesisSide $side
     * @return OrderItemsType
     */
    private function getWristSide(ProthesisSide $side): OrderItemsType
    {
        return $side === ProthesisSide::LEFT
            ? OrderItemsType::LEFT_PROTHESIS_WRIST
            : OrderItemsType::RIGHT_PROTHESIS_WRIST;
    }

    /**
     * @param CreateOrderItemsDTO $dto
     * @return bool
     * @throws Exception
     */
    private function createRelations(CreateOrderItemsDTO $dto): bool
    {
        try {
            $orderItems = $this->orderItemsRepository->create($dto);

            foreach ($dto->items as $product) {
                $this->itemsRepository->create(
                    new CreateItemDTO(
                        orderItems: $orderItems,
                        product: $product,
                        side: $dto->side,
                    ),
                );
            }
        } catch (Exception $e) {
            throw new Exception(
                message: 'При обработке данных возникла ошибка ' . $e->getMessage(),
            );
        }

        return true;
    }
}
