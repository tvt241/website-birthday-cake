<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Traits\ResponseTrait;
use Modules\Setting\Http\Requests\UpdateCompanyRequest;
use Modules\Setting\Models\BusinessSetting;
use Modules\Setting\Resources\ConfigResource;
use Modules\Setting\Resources\ServiceResource;

class BusinessApiSettingController extends Controller
{
    use ResponseTrait;
    public function getConfig(Request $request)
    {
        $group = $request->group;
        $query = BusinessSetting::where("group", $group);
        if($key = $request->key){
            $query->where("key", $key);
        }
        $configs = $query->get();
        return $this->SuccessResponse(ConfigResource::collection($configs));
    }

    public function getService(Request $request)
    {
        $service = $request->service;
        $config = BusinessSetting::where("group", $service)->where("key", "services")->first();

        $configUsing = BusinessSetting::where("group", $service)->where("key", "using")->first();

        $services = explode(",", $config->value);

        $configs = BusinessSetting::where("group", "services")->whereIn("key", $services)->get();

        $config->services = $services;
        $config->configs = $configs;
        $config->using = $configUsing;

        return $this->SuccessResponse(new ServiceResource($config));
    }

    public function updateCompanyConfig(UpdateCompanyRequest $request){
        $hostPath = "/storage/";
        $configs = $request->validated();
        if($request->logo){
            $url = Storage::disk("public")->putFile("setup", $request->logo);
            $configs["logo"] = $hostPath . $url;
        }

        if($request->fav_icon){
            $url = Storage::disk("public")->putFile("setup", $request->fav_icon);
            $configs["fav_icon"] = $hostPath . $url;
        }
        foreach($configs as $key => $config){
            $configCurrent = BusinessSetting::where("group", "company")->where("key", $key)->first();
            $configCurrent->value = $config;
            $configCurrent->save();
        }
        Cache::forget("company");
        return $this->SuccessResponse([]);
    }
}
