<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Order\Services\PaymentService\VnPayService;
use PDO;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('order::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('order::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request, VnPayService $vnPayService)
    {
        $order = [
            "code" => "DHB-CN1-1304231625",
            "amount" => "1000000"
        ];
        return $vnPayService->create($order);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('order::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('order::edit');
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

    public function payment(Request $request){
        dd($request->all());
        $message = "";
        switch ($request->name) {
            case 'VNPAY':
                $payment = [
                    "name" => "VNPAY",
                    "value" => json_encode($request->except(["name", "vnp_SecureHash"]))
                ];
                if($request->vnp_ResponseCode !== 00){
                    $message .= $request->vnp_ResponseCode;
                }
                if($request->vnp_TransactionStatus !== 00){
                    $message .= $request->vnp_TransactionStatus;
                }
                if(!empty($message)){
                    return;
                }
                break;
            default:
                # code...
                break;
        }
        return; 
    }
}
