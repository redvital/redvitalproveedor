<?php

namespace App\Http\Controllers\Api\AdditionalSupplierInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdditionalSupplierInformation;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Provider;
use App\Http\Resources\AdditionalSupplierInformationResource;
use Illuminate\Support\Facades\Storage;
class AdditionalSupplierInformationController extends Controller
{

    private $rules = [
        'fiscal_address' => 'required',
        'state' => 'required',
        'postal_code' => 'required',
        'commercial_name' => 'required',
        'payment_condition' => 'required',
        'commercial_register' => 'required',
        'rif' => 'required',
        'identification_document' => 'required',
        'retention' => 'required',
        'consignment'=> 'required',

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
        // return  [Storage::disk('s3')->put("commercial", $request->file('rif'), 'public'), Storage::disk('s3')->put("commercial-register-file", $request->file('commercial_register'), 'public')];
        $data = array_merge(
            $request->all(),[
            'supplier_id' => $supplier_id->id,
            'rif' =>  Storage::disk('s3')->put("imagen-rif",  $request->file('rif'), 'public'),
            'commercial_register' => Storage::disk('s3')->put("commercial-register-file", $request->file('commercial_register'), 'public'),
            'identification_document' => Storage::disk('s3')->put("identification-file", $request->file('identification_document'), 'public')
            ]
        );
        // TODO: AGREGAR VALIDACION SI EXIXTE ADICONAL INFORMATION, SINO EXISTE CREA UN REGIISTRO NUEVO SI TIENE REGISTRO NO CRER NUEVO SINO ACTUALIZAR
        $additionalSupplierInformation = AdditionalSupplierInformation::create($data);
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
