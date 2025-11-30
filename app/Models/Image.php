<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $link
 * @property string $path
 * @property ProductImage $productImage
 * @method static find(\Illuminate\Routing\Route|object|string|null $route)
 */
class Image extends Model
{
    use HasFactory;

    public function productImage(): HasOne
    {
        return $this->HasOne(ProductImage::class);
    }
}
