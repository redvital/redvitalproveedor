<?php

namespace App\Http\Controllers\Api\SupplierBankDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierBankDetails;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SupplierBankDetailsController extends Controller
{

    private $rules = [
        'bank' => 'required',
        'currency' => 'required',
        'method_of_payment' => 'required',
        'account_type' => 'required',
        'account_number' => 'required',
        'account_holder' => 'required',
        'rif' => 'required',
        'provider_id' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplierBankDetails = SupplierBankDetails::all();
        return $this->showAll($supplierBankDetails);
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
        $supplierBankDetails = SupplierBankDetails::create(
            $request->all(),
        );
        return $this->showOne($supplierBankDetails, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SupplierBankDetails $supplierBankDetails)
    {
        return $this->showOne($supplierBankDetails);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierBankDetails $supplierBankDetails)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $supplierBankDetails->update($request->all());
        return $this->showOne($supplierBankDetails);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierBankDetails $supplierBankDetails)
    {
        $supplierBankDetails->delete();
        return $this->showOne($supplierBankDetails);
    }
}
