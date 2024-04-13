<?php
namespace Modules\Core\Services\Location;

use Modules\Core\Helpers\HttpGhnHelper;
use Modules\Core\Resources\Location\District\DistrictGhnResource;
use Modules\Core\Resources\Location\Province\ProvinceGhnResource;
use Modules\Core\Resources\Location\Ward\WardGhnResource;
use Modules\Core\Traits\ResponseTrait;

class LocationGhnService implements ILocationService
{
    use ResponseTrait;
    public $http;

    public function __construct(HttpGhnHelper $httpGhnHelper)
    {
        $this->http = $httpGhnHelper;
    }

    public function province()
    {
        $url = "shiip/public-api/master-data/province";
        try {
            $response = $this->http->post($url, []);
            $result = $response->object();
            if($result->code != 200){
                return $this->ErrorResponse($result->message);
            }
            $provinces = collect($result->data);
            return $this->SuccessResponse(ProvinceGhnResource::collection($provinces));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function district($province)
    {
        $url = "shiip/public-api/master-data/district";
        $data = [
            "province_id" => (int)$province
        ];
        try {
            $response = $this->http->post($url, $data);
            $result = $response->object();
            if($result->code != 200){
                return $this->ErrorResponse($result->message);
            }
            $districts = collect($result->data);
            return $this->SuccessResponse(DistrictGhnResource::collection($districts));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function ward($district)
    {
        $url = "shiip/public-api/master-data/ward";
        $data = [
            "district_id" => (int)$district
        ];
        try {
            $response = $this->http->post($url, $data);
            $result = $response->object();
            if($result->code != 200){
                return $this->ErrorResponse($result->message);
            }
            $wards = collect($result->data);
            return $this->SuccessResponse(WardGhnResource::collection($wards));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}