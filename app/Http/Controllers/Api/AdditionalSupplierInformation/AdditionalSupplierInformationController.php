<?php

namespace App\Http\Controllers\Api\AdditionalSupplierInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdditionalSupplierInformation;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AdditionalSupplierInformationController extends Controller
{

    private $rules = [
        'fiscal_address' => 'required',
        'state' => 'required',
        'postal_code' => 'required',
        'commercial_name' => 'required',
        'payment_condition' => 'required',
        'representative_id' => 'required',
        'supplier_id' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additionalSupplierInformation = AdditionalSupplierInformation::all();
        return $this->showAll($additionalSupplierInformation);
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
        $additionalSupplierInformation = AdditionalSupplierInformation::create(
            $request->all(),
        );
        return $this->showOne($additionalSupplierInformation, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AdditionalSupplierInformation $additionalSupplierInformation)
    {
        return $this->showOne($additionalSupplierInformation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdditionalSupplierInformation $additionalSupplierInformation)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $additionalSupplierInformation->update($request->all());
        return $this->showOne($additionalSupplierInformation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditionalSupplierInformation $additionalSupplierInformation)
    {
        $additionalSupplierInformation->delete();
        return $this->showOne($additionalSupplierInformation);
    }
}
