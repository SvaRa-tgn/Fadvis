<?php

namespace App\Models;

use App\Enum\ProthesisSide;
use App\Enum\ProthesisType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $number
 * @property int $user_id
 * @property int $patient_id
 * @property ProthesisSide $side
 * @property ProthesisType $left_type
 * @property ProthesisType $right_type
 * @method static where(string $string, string $number)
 */
class Order extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
