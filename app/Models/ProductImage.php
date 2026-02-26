<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $image_id
 * @property Product $product
 */

class ProductImage extends Model
{

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
