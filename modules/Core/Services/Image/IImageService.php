<?php

namespace Modules\Core\Services\Image;

interface IImageService {
    public function store();
    public function update();
    public function destroy();
}