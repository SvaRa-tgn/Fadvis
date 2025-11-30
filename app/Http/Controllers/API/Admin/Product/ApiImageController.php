<?php

namespace App\Http\Controllers\API\Admin\Product;

use App\Actions\API\Admin\Image\ApiAddImageAction;
use App\Actions\API\Admin\Image\ApiDeleteImageAction;
use App\Actions\API\Admin\Image\ApiUpdateImageAction;
use App\Actions\API\Admin\Image\ApiUpdateImagePatientAction;
use App\Http\Requests\Admin\Image\AddImageRequest;
use App\Http\Requests\Admin\Image\UpdateImagePatientRequest;
use App\Http\Requests\Admin\Image\UpdateImageProductRequest;
use App\Models\Image;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiImageController
{
    /** @throws Exception */
    public function add(AddImageRequest $request, ApiAddImageAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }

    /** @throws Exception */
    public function update(UpdateImageProductRequest $request, ApiUpdateImageAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }

    /** @throws Exception */
    public function updateImagePatient(UpdateImagePatientRequest $request, ApiUpdateImagePatientAction $action): JsonResponse
    {
        return $action->execute($request->getDto());
    }

    /** @throws Exception */
    public function delete(ApiDeleteImageAction $action, Image $image): JsonResponse
    {
        return $action->execute($image);
    }
}
