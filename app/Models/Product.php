<?php

namespace App\Models;

use App\Enum\ProthesisLevel;
use App\Enum\Status;
use App\Enum\CountryMade;
use App\Enum\ManufacturerList;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisSize;
use App\Enum\ProthesisType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $article
 * @property int $category_id
 * @property Category $category
 * @property string $type
 * @property string $description
 * @property string $size
 * @property string $side
 * @property string $level
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
 * @method static Product find(int $id)
 */
class Product extends Model
{
    use HasFactory;

    public function getStatus(): Status
    {
        return Status::tryFrom($this->status);
    }

    public function getType(): ProthesisType
    {
        return ProthesisType::tryFrom($this->type);
    }

    public function getLevel(): ProthesisLevel
    {
        return ProthesisLevel::tryFrom($this->level);
    }

    public function getSize(): ProthesisSize
    {
        return ProthesisSize::tryFrom($this->size);
    }

    public function getSide(): ProthesisSide
    {
        return ProthesisSide::tryFrom($this->side);
    }

    public function getMade(): CountryMade
    {
        return CountryMade::tryFrom($this->made);
    }

    public function getManufacturer()
    {
        return ManufacturerList::tryFrom($this->manufacturer);
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
}
