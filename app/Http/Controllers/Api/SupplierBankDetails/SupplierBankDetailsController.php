<?php

namespace App\Http\Controllers\Api\SupplierBankDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierBankDetails;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Provider;
use App\Http\Resources\BankDetailsResourse;
use Illuminate\Support\Facades\Storage;

class SupplierBankDetailsController extends Controller
{

    private $rules = [
        'bank' => 'required',
        'currency' => 'required',
        'method_of_payment' => 'required',
        'account_type' => 'required',
        'account_number' => 'required',
        'account_holder' => 'required',
        'rif' => 'required'
    ];


    public $errorProviderNotFound = 'No provider found with this id';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Provider $supplier_id)
    {
        
        $supplierBankDetails = BankDetailsResourse::collection(SupplierBankDetails::where('supplier_id', $supplier_id->id)->get());
        return $this->paginate($supplierBankDetails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Provider $supplier_id)
    {
        $validate = Validator::make($request->all(), $this->rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
            $supplierBankDetails = SupplierBankDetails::create(
                [
                    'bank' => $request->bank,
                    'currency' => $request->currency,
                    'method_of_payment' => $request->method_of_payment,
                    'account_type' => $request->account_type,
                    'account_number' => $request->account_number,
                    'account_holder' => $request->account_holder,
                    'rif' => Storage::disk('s3')->put("details-file-rif", $request->file('rif'), 'public'),
                    'supplier_id' => $supplier_id->id
                ]
            );
            return $this->showOne($supplierBankDetails, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SupplierBankDetails $supplierBankDetails )
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

        $supplierBankDetails->fill($request->all());
        if($supplierBankDetails->isClean())
        {
            return $this->errorResponse("Al menos un valor debe cambiar" , Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $supplierBankDetails->save();
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
