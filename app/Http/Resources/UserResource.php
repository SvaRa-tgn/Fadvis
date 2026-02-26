<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'surname'      => $this->surname,
            'name'         => $this->name,
            'patronymic'   => $this->patronymic,
            'email'        => $this->email,
            'phone'        => $this->phone,
            'site'         => $this->site,
            'messenger'    => $this->messenger,
            'organization' => $this->organization,
            'address'      => $this->address,
            'inn'          => $this->inn,
            'ogrn'         => $this->ogrn,
            'role'         => $this->role,
        ];
    }
}
