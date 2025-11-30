<?php

namespace App\Models;

use App\Enum\ProthesisLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property int $amount
 * @property int $total_amount
 * @property ProthesisLevel $level
 */
class Item extends Model
{
    use HasFactory;

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): belongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
