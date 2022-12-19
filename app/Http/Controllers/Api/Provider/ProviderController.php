<?php

namespace App\Http\Controllers\Api\Provider;

use Error;
use App\Models\Product;
use App\Models\Provider;
use App\Rules\ExcelRule;
use Illuminate\Http\Request;
use App\Models\ProductProvider;
use App\Models\SupplierBankDetails;
use App\Http\Controllers\Controller;
use App\Jobs\ImportProveedoresInfoJob;
use App\Http\Resources\ProviderResourse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

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
        $providerForUser = auth()->user()->Provider;
        $provider = ProviderResourse::collection($providerForUser);
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
        error_log($request);
        $validate = Validator::make($request->all(), $this->rules);

        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }

        if ($this->existRifProvider($request->rif)) {
            return $this->errorResponse($this->errorRifFound, Response::HTTP_BAD_REQUEST);
        } else {
            $data = array_merge($request->all(), ["user_id" => auth()->user()->id]);
            $provider = Provider::create($data);
            // return $this->successResponse($provider);
             return $this->showOne($provider, 201);
        }

    }


    public function show(Request $request, Provider $provider)
    {
        // todo: mostrar informacion si le pertenece al user registrado


       $provider->products;
        // return $productForProvider;
        
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

        // todo: actualizar informacion si le pertenece al user registrado
        $provider->fill($request->all());
        if($provider->isClean())
        {
            return $this->errorResponse("Al menos un valor debe cambiar" , Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $provider->save();
        return $this->showOne($provider);
    }

    public function destroy(Provider $provider)
    {
        // todo: eliminar informacion si le pertenece al user registrado
        $provider->delete();
        return $this->showOne($provider);
    }

    public function existRifProvider($rif)
    {
        return Provider::where('rif', $rif)->first();
    }
    public function import(Request $request){
        $validate = Validator::make($request->all(), [
            'import' => ['required', new ExcelRule($request->file('import'))],
        ]);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
    
       error_log("ejecutado importancion");
       $job = new ImportProveedoresInfoJob(
           $request->file('import'),
           $request->user(),
           1
       );

       $this->dispatch($job);

       return $this->successMessage($job->respuestaJson());
    }
}

