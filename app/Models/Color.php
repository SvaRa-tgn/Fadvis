<?php

namespace App\Models;

use App\Enum\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $article
 * @property string $link
 * @property string $path
 * @property string $status
 * @method static find(\Illuminate\Routing\Route|object|string|null $route)
 * @method static where(string $string, string $value)
 */

class Color extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => Status::class,
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id', 'color_id');
    }
}
