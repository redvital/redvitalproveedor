<?php

namespace App\Http\Controllers\Api\AdditionalSupplierInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdditionalSupplierInformation;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Provider;
use App\Http\Resources\AdditionalSupplierInformationResource;

class AdditionalSupplierInformationController extends Controller
{

    private $rules = [
        'fiscal_address' => 'required',
        'state' => 'required',
        'postal_code' => 'required',
        'commercial_name' => 'required',
        'payment_condition' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Provider $supplier_id)
    {
        $additionalSupplierInformation = AdditionalSupplierInformationResource::collection(AdditionalSupplierInformation::where('supplier_id', $supplier_id->id)->get());
        return $this->paginate($additionalSupplierInformation);
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
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $additionalSupplierInformation = AdditionalSupplierInformation::create(
            [
                'fiscal_address' => $request->fiscal_address,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'web_page' => $request->web_page,
                'commercial_name' => $request->commercial_name,
                'payment_condition' => $request->payment_condition,
                'retention' => $request->retention,
                'consignment' => $request->consignment,
                'representative_id' => $request->representative_id,
                'supplier_id' => $supplier_id->id,
                'rif' => $request->rif,
                'commercial_register' => $request->commercial_register,
                'identification_document' => $request->identification_document,
            ]
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
