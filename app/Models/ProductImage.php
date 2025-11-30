<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property int $image_id
 */

class ProductImage extends Model
{
    use HasFactory;
}
