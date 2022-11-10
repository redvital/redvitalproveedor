<?php

namespace App\Http\Controllers\Api\PaymentType;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'payment_type' => 'required'
    ];

    public function index()
    {
        $payment_type = PaymentType::all();
        return $this->showAll($payment_type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $payment_type = PaymentType::create(
            $request->all(),
        );
        return $this->showOne($payment_type, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PaymentType $payment_type)
    {
        return $this->showOne($payment_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentType $payment_type)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $payment_type->fill($request->all());
        if ($payment_type->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $payment_type->save();
        return $this->showOne($payment_type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentType $payment_type)
    {
        $payment_type->delete();
        return $this->showOne($payment_type);
    }
}
