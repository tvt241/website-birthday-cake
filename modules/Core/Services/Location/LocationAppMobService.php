<?php
namespace Modules\Core\Services\Location;

use Modules\Core\Helpers\HttpAppMobHelper;
use Modules\Core\Resources\Location\District\DistrictAppMobResource;
use Modules\Core\Resources\Location\Province\ProvinceAppMobResource;
use Modules\Core\Resources\Location\Ward\WardAppMobResource;
use Modules\Core\Traits\ResponseTrait;

class LocationAppMobService implements ILocationService
{
    use ResponseTrait;
    public $http;

    public function __construct(HttpAppMobHelper $httpAppMobHelper)
    {
        $this->http = $httpAppMobHelper;
    }

    public function province()
    {
        $url = "api/province";
        try {
            $response = $this->http->get($url);
            $result = $response->object();
            if(!isset($result->results)){
                return $this->ErrorResponse("Vui lòng thử lại sau");
            }
            $provinces = collect($result->results);
            return $this->SuccessResponse(ProvinceAppMobResource::collection($provinces));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function district($province)
    {
        $url = "/api/province/district/" . $province;
        try {
            $response = $this->http->get($url);
            $result = $response->object();
            if(!isset($result->results)){
                return $this->ErrorResponse("Vui lòng thử lại sau");
            }
            if(empty($result->results)){
                return $this->ErrorResponse("Mã thành phố không hợp lệ hoặc chưa có trên hệ thống");
            }
            $districts = collect($result->results);
            return $this->SuccessResponse(DistrictAppMobResource::collection($districts));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function ward($district)
    {
        $url = "/api/province/ward/" . $district;
        try {
            $response = $this->http->get($url);
            $result = $response->object();
            if(!isset($result->results)){
                return $this->ErrorResponse("Vui lòng thử lại sau");
            }
            if(empty($result->results)){
                return $this->ErrorResponse("Mã quận/ huyện không hợp lệ hoặc chưa có trên hệ thống");
            }
            $wards = collect($result->results);
            return $this->SuccessResponse(WardAppMobResource::collection($wards));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}