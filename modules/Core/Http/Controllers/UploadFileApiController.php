<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\Image\IImageService;
use Modules\Core\Traits\ResponseTrait;

class UploadFileApiController extends Controller
{
    use ResponseTrait;
    public function ckeditorUpload(Request $request){
        $prefix = "upload-files";
        try {
            $url = Storage::disk("public")->putFile($prefix, $request->upload);
            $url = "/storage/" . $url;
            return response()->json([
                "url" => $url
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
}
