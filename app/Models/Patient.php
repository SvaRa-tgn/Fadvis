<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property string $phone
 * @property string $email
 * @property PatientImage $images
 * @method static find(\Illuminate\Routing\Route|object|string|null $route)
 */
class Patient extends Model
{
    use HasFactory;

    public function images(): belongsToMany
    {
        return $this->belongsToMany(Image::class, 'patient_images', 'patient_id', 'image_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
