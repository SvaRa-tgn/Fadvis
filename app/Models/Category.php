<?php

namespace App\Models;

use App\Enum\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $second_name
 * @property string $description
 * @property string $link
 * @property string $path
 * @property string $status
 * @property Collection $products
 * @method static Category find(int $int)
 * @method static where($string, $criteria)
 */
class Category extends Model
{


    protected $casts = [
        'status' => Status::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
