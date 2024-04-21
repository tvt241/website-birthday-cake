<?php

namespace Modules\Customer\Http\Controllers\Auth\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Enums\CustomerKeyLoginEnum;
use Modules\Customer\Http\Requests\LoginCustomerRequest;

class LoginApiController extends Controller
{
    public function handleLogin(LoginCustomerRequest $request)
    {
        // $pattern = '/^(84|\+84|0)\d{9}$/';
        $key = "username";
        if(is_numeric($request->username)){
            $key = "phone";
        }
        else if(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $key = "email";
        }
        $user = Auth::guard("customer_web")->attempt([
            $key => $request->username,
            "password" => $request->password,
            "social" => null
        ]);
        if(!$user){
            $message = CustomerKeyLoginEnum::getValue($key) . " hoặc mật khẩu không chính xác";
            return back()->withInput()->with("message", $message);
        }
        return view("customer::pages.home");
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customer::create');
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
        return view('customer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('customer::edit');
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
