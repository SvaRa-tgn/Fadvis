<?php

namespace App\Models;

use App\Enum\ProthesisSide;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_items_id
 * @property int $product_id
 * @property string $side
 * @property Collection $products
 */
class Item extends Model
{
    protected $casts = [
        'side' => ProthesisSide::class,
    ];

    public function products(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItem(): belongsTo
    {
        return $this->belongsTo(OrderItems::class, 'order_items_id');
    }

    public function order(): belongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
