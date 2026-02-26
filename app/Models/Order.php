<?php

namespace App\Models;

use App\Enum\ProthesisSide;
use App\Enum\ProthesisType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $number
 * @property int $user_id
 * @property int $patient_id
 * @property string $description
 * @property float $amount
 * @property User $user
 * @property Patient $patient
 * @property string $formatted_total
 * @property Collection $items
 * @property Collection $orderItems
 * @method static where(string $string, string $number)
 */
class Order extends Model
{
    use HasFactory;

    public function getRouteKeyName(): string
    {
        return 'number';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItems::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getProthesisTypes(): \Illuminate\Support\Collection
    {
        return $this->orderItems->pluck('prothesis');
    }

    public function getFormattedTotalAttribute(): string
    {
        return number_format($this->amount, 2, '.', ' ');
    }
}
