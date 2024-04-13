<?php

namespace Modules\Core\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Services\Location\ILocationService;

class LocationApiController extends Controller
{
    private $iLocationService;

    public function __construct(ILocationService $iLocationService)
    {
        $this->iLocationService = $iLocationService;
    }

    public function provinces()
    {
        return $this->iLocationService->province();
    }

    public function districts(Request $request, $province){
        return $this->iLocationService->district($province);
    }

    public function wards(Request $request, $district){
        return $this->iLocationService->ward($district);
    }

}
