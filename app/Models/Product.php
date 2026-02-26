<?php

namespace App\Models;

use App\Enum\ProthesisGrip;
use App\Enum\CountryMade;
use App\Enum\ManufacturerList;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisSize;
use App\Enum\ProthesisType;
use App\Enum\ProthesisSystem;
use App\Enum\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $article
 * @property int $category_id
 * @property Category $category
 * @property string $type
 * @property ?string $grip
 * @property string $description
 * @property string $size
 * @property string $side
 * @property string $level
 * @property string $system
 * @property int $volume_size
 * @property int $length_size
 * @property float $price
 * @property int $color_id
 * @property Color $color
 * @property boolean $is_select_color
 * @property string $made
 * @property string $manufacturer
 * @property string $link
 * @property string $path
 * @property string $status
 * @property ProductImage $images
 */
class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'status'       => Status::class,
        'manufacturer' => ManufacturerList::class,
        'side'         => ProthesisSide::class,
        'size'         => ProthesisSize::class,
        'type'         => ProthesisType::class,
        'level'        => ProthesisLevel::class,
        'made'         => CountryMade::class,
        'grip'         => ProthesisGrip::class,
        'system'       => ProthesisSystem::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function color(): belongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function images(): belongsToMany
    {
        return $this->belongsToMany(Image::class, 'product_images', 'product_id', 'image_id');
    }

    public function getFormattedTotalAttribute(): string
    {
        return number_format($this->price, 2, '.', ' ');
    }
}
