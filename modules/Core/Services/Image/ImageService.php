<?php

namespace Modules\Core\Services\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService implements IImageService {
    public $hostPath;
    public function __construct()
    {
        // $this->hostPath = env("APP_URL") . "/storage/";
        $this->hostPath = "/storage/";
    }

    public function store(UploadedFile $file, $model, $prefix = ""){
        $url = Storage::disk("public")->putFile($prefix, $file);
        $url = $this->hostPath . $url;
        $model->image()->create(["url" => $url]);
        return $url;
    }

    public function update(UploadedFile $file, $model, $prefix = ""){
        $url = Storage::disk("public")->putFile($prefix, $file);
        $url = $this->hostPath . $url;

        $data = [
            "url" => $url
        ];
        $image = $model->image;
        if(isset($image->url)){
            $path = str_replace($this->hostPath, "", $image->url);
            Storage::disk("public")->delete($path);
            $model->image()->update($data);
            return $url;
        }
        $model->image()->create($data);
        return $url;
    }

    public function destroy($model){
        $image = $model->image;
        if(isset($image->url)){
            $path = str_replace($this->hostPath, "", $image->url);
            Storage::disk("public")->delete($path);
            $image->delete();
        }
    }

}