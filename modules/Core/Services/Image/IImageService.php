<?php

namespace Modules\Core\Services\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

interface IImageService {
    public function store(UploadedFile $file, $model, $prefix = "");
    public function update(UploadedFile $file, $model, $prefix = "");
    public function destroy($model);
}