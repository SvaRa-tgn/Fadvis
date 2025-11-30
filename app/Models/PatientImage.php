<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $patient_id
 * @property int $image_id
 */
class PatientImage extends Model
{
    use HasFactory;

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}


