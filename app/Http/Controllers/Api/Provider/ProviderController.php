<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\ProductProvider;
use App\Models\Product;
use App\Models\SupplierBankDetails;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ProviderResourse;

class ProviderController extends Controller
{

    private $rules = [
        'name' => 'required',
        'email' => 'required',
        'company' => 'required',
        'rif' => 'required',
        'provider_type' => 'required',
    ];


    public $errorRifFound = 'This rif is already registered';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $provider = ProviderResourse::collection(Provider::all());
        return $this->paginate($provider);
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

        if ($this->existRifProvider($request->rif)) {
            return $this->errorResponse($this->errorRifFound, Response::HTTP_BAD_REQUEST);
        } else {
            error_log("error despues de estas validaciones");
            $provider = Provider::create(
                $request->all(),
            );
            return $this->showOne($provider, 201);
        }

    }


    public function show(Request $request, Provider $provider)
    {
        return $this->showOne($provider);
    }

    public function detail(Request $request, Provider $provider)
    {
        // $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $out->writeln($provider->id);
        $validate = Validator::make($request->all(), $this->rulesDetails);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }

        $details = new SupplierBankDetails();
        $details->bank = $request->bank;
        $details->currency = $request->currency;
        $details->method_of_payment = $request->method_of_payment;
        $details->account_type = $request->account_type;
        $details->account_number = $request->account_number;
        $details->account_holder = $request->account_holder;
        $details->rif = $request->rif;
        $details->provider = $provider->id;
        $details->observations = $request->observations;
        $details->save();
        return $this->showOne($details, 201);
    }

    public function update(Request $request, Provider $provider)
    {

        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $provider->update($request->all());
        return $this->showOne($provider);
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();
        return $this->showOne($provider);
    }

    public function existRifProvider($rif)
    {
        return Provider::where('rif', $rif)->first();
    }
}

