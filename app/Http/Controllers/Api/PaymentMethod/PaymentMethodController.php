<?php

namespace App\Http\Controllers\Api\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DDList\PaymentMethodDDListResource;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'payment_method' => 'required'];

    public function index()
    {
        $payment_method = PaymentMethods::all();
        return $this->showAll($payment_method);
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
        $payment_method = PaymentMethods::create(
            $request->all(),
        );
        return $this->showOne($payment_method, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PaymentMethods $payment_method)
    {
        return $this->showOne($payment_method);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethods $payment_method)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $payment_method->fill($request->all());
        if ($payment_method->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $payment_method->save();
        return $this->showOne($payment_method);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethods $payment_method)
    {
        $payment_method->delete();
        return $this->showOne($payment_method);
    }

    public function ddlist()
    {
        $payment_method = PaymentMethods::all();
        return $this->showAll($payment_method);
    }

    public function ddlistResource()
    {
        $payment_method = PaymentMethodDDListResource::collection(PaymentMethods::all());
        return $payment_method;
    }

}
