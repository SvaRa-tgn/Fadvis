<?php

namespace App\Models;

use App\Enum\OrderItemsType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $id
 * @property int $order_id
 * @property string $prothesis
 * @property float $amount
 * @property Collection $items
 */
class OrderItems extends Model
{
    use HasFactory;

    protected $casts = [
        'prothesis' => OrderItemsType::class,
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'order_items_id', 'id');
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: Product::class,
            through: Item::class,
            firstKey: 'order_items_id',
            secondKey: 'id',
            localKey: 'id',
            secondLocalKey: 'product_id'
        );
    }

    public function getFormattedTotalAttribute(): string
    {
        return number_format($this->amount, 2, '.', ' ');
    }
}
