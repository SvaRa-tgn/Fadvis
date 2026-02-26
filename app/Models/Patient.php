<?php

namespace App\Models;

use App\Enum\GenderType;
use App\Enum\MessengerType;
use App\Enum\ProthesisLevel;
use App\Enum\ProthesisType;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property CarbonImmutable $birth_date
 * @property string $gender
 * @property string $phone
 * @property string $email
 * @property string $messenger
 * @property string $left_type
 * @property string $right_type
 * @property string $left_level
 * @property string $right_level
 * @property PatientImage $images
 * @method static find(\Illuminate\Routing\Route|object|string|null $route)
 */
class Patient extends Model
{
    use HasFactory;

    protected $casts = [
        'birth_date'  => 'datetime:d.m.Y',
        'gender'      => GenderType::class,
        'messenger'   => MessengerType::class,
        'left_type'   => ProthesisType::class,
        'right_type'  => ProthesisType::class,
        'left_level'  => ProthesisLevel::class,
        'right_level' => ProthesisLevel::class,
    ];

    public function images(): belongsToMany
    {
        return $this->belongsToMany(Image::class, 'patient_images', 'patient_id', 'image_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
