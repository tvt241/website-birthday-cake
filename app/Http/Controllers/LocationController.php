<?php

namespace App\Http\Controllers;

use App\Helpers\HttpHelperGhn;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $http;

    public function __construct(HttpHelperGhn $httpHelperGhn)
    {
        $this->http = $httpHelperGhn;
    }

    public function provices(){
        
    }
}
