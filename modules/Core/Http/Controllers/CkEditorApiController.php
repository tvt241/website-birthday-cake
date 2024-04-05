<?php

namespace Modules\Core\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CkEditorApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function token()
    {
        $environmentId = env('CKBOX_ENVIRONMENT_ID');
        $accessKey = env('CKBOX_ACCESS_KEY');

        $payload = [
            'aud' => $environmentId,
            'iat' => time(),
            'sub' => 'unique-user-id',
            'auth' => [
                'ckbox' => [
                    'role' => 'superadmin',
                ]
            ]
        ];

        $jwtToken = JWT::encode($payload, $accessKey, 'HS256');

        return response($jwtToken);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('core::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('core::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('core::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
