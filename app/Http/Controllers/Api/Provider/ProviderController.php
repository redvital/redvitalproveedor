<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\ProductProvider;
use App\Models\Product;
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

    private $productProiderRules = [
        'product_id' => 'required',
        'provider_id' => 'required',
        'commercialized' => 'required',
        'approved' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider = Provider::all();
        return $this->showAll($provider);
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
        $provider = Provider::create(
            $request->all(),
        );
        return $this->showOne($provider, 201);
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

    public function showProductProvider(Request $request, ProductProvider $supplier_id){

        $pivot = ProductProvider::where('provider_id', $supplier_id->id)->get();

        if(!empty($pivot)){
            $productsProvider = $pivot->map(function ($element) {
                return  $element->product_id;
            });
            $products = Product::whereIn('id', $productsProvider)->get();
            return $this->showAll($products);
        }else {
            return $this->errorResponse('No products found for this supplier', Response::HTTP_BAD_REQUEST);
        }
    }

    public function showCommercializedProduct (Request $request, ProductProvider $supplier_id, $commercialized){

        if($commercialized == 'true'){
            $commercialized = 1;
        }else{
            $commercialized = 0;
            }

        $pivot = ProductProvider::where('provider_id', $supplier_id->id)->where('commercialized', $commercialized)->get();

        if(count($pivot)>0){
            $productsProvider = $pivot->map(function ($element) {
                return  $element->product_id;
            });
            $products = Product::whereIn('id', $productsProvider)->get();
            return $this->showAll($products);
        }else {
            return $this->errorResponse('No products found for this supplier', Response::HTTP_BAD_REQUEST);
        }

        return $pivot;
    }

    public function showApprovedProduct (Request $request, ProductProvider $supplier_id, $approved){

        if($approved == 'true'){
            $approved = 1;
        }else{
            $approved = 0;
            }

        $pivot = ProductProvider::where('provider_id', $supplier_id->id)->where('approved', $approved)->get();

        if(count($pivot)>0){
            $productsProvider = $pivot->map(function ($element) {
                return  $element->product_id;
            });
            $products = Product::whereIn('id', $productsProvider)->get();
            return $this->showAll($products);
        }else {
            return $this->errorResponse('No products found for this supplier', Response::HTTP_BAD_REQUEST);
        }

        return $pivot;
    }

    public function storeProductProvider (Request $request, Provider $provider, Product $product){

    }

}

