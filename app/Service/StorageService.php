<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    public static function deleteImage(string $path): void
    {
        Storage::delete($path);
    }

    public static function updateImage(string $storage, string $image): array
    {
        $path = Storage::putFile($storage, $image);
        $url = Storage::url($path);

        return ['path' => $path, 'url' => $url];
    }

    /**public static function excelupload(ExcelRequest $request)
    {
        return Storage::putFile('public/excel', $request->excel);
    }

    public static function destroyExcel(string $path)
    {
        Storage::delete($path);
    }*/

}
