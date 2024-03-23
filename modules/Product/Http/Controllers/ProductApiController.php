<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductApiController extends Controller
{

    public function index()
    {
        return view('product::index');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
