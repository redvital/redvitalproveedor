<?php

namespace App\Http\Controllers\Api\SpecialFormOfPayment;

use App\Http\Controllers\Controller;
use App\Models\SpecialFormsOfPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SpecialFormsOfPaymenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'form_of_payment' => 'required'
    ];

    public function index()
    {
        $special_form_of_payment = SpecialFormsOfPayment::all();
        return $this->showAll($special_form_of_payment);
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
        $special_form_of_payment = SpecialFormsOfPayment::create(
            $request->all(),
        );
        return $this->showOne($special_form_of_payment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SpecialFormsOfPayment $special_form_of_payment)
    {
        return $this->showOne($special_form_of_payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecialFormsOfPayment $special_form_of_payment)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $special_form_of_payment->fill($request->all());
        if ($special_form_of_payment->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $special_form_of_payment->save();
        return $this->showOne($special_form_of_payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialFormsOfPayment $special_form_of_payment)
    {
        $special_form_of_payment->delete();
        return $this->showOne($special_form_of_payment);
    }
}
