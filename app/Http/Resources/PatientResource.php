<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'user_id'      => $this->user_id,
            'surname'      => $this->surname,
            'name'         => $this->name,
            'patronymic'   => $this->patronymic,
            'birth_date'   => $this->birth_date,
            'gender'       => $this->gender,
            'phone'        => $this->phone,
            'email'        => $this->email,
            'messenger'    => $this->messenger,
            'left_type'    => $this->left_type,
            'right_type'   => $this->right_type,
            'left_level'   => $this->left_level,
            'right_level'  => $this->right_level,
            'images'       => $this->images->map(function($image) {
                return [
                    'id'  => $image->id,
                    'url' => $image->url,
                ];
            }),
        ];
    }
}
