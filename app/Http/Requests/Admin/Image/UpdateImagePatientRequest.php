<?php

namespace App\Http\Requests\Admin\Image;

use App\DTO\Admin\Image\AddImageDTO;
use App\DTO\Admin\Image\UpdateImagePatientDTO;
use App\DTO\Admin\Image\UpdateImageProductDTO;
use App\Models\Image;
use App\Models\Patient;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateImagePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image_patient' => ['required', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'image_patient.required' => 'Вы не выбрали фотографию',
        ];
    }

    /** DTO после валидации данных */
    public function getDto(): UpdateImagePatientDTO
    {
        return new UpdateImagePatientDTO(
            patient: Patient::find($this->route('patient')),
            image: Image::find($this->route('image')),
            image_patient: $this->file('image_patient'),
        );
    }
}
