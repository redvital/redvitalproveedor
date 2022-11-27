<?php

namespace App\Http\Controllers\Api\Store;

use Exception;
use App\Models\Stock;
use App\Models\Stores;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Models\ProductProvider;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductStore;
use App\Http\Resources\StoreResource;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    private $rules = [
        'name' => 'required',
        'code' => 'required',

    ];




    public function addStock(Request $request){
         $product = $request->query('product');
         $provider = $request->query('provider');
         $store = $request->query('store');
         $rules = [
            'quantity' => 'required'    
        ];
         $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
         if(empty($product) || empty($provider) || empty($store)){
            return $this->errorResponse("Error, Aún faltan parametros en la URL: product, provider o store ", 400) ;;
         }
         try{
           $validateStore =  Stores::findOrFail($store);
            Product::findOrFail($product);
            Provider::findOrFail($provider);

            $produstProvider = ProductProvider::whereId($product)->whereId($provider)->first();
            if(!empty($produstProvider)){
                $stockExistvalidate = Stock::where('product_providers_id', $produstProvider->id)->where('store_id', $store)->first();
                
                if( empty($stockExistvalidate)){
                    $stock = Stock::create([
                        'product_providers_id' => $produstProvider->id,
                        'store_id' => $store,
                        'quantity' => $request->quantity
                    ]);

                    return $this->showOne($stock, 200);
                };
               
                
            }
            return $this->errorResponse("Error, el producto ya se encuentra registrado en stock de la tienda: $validateStore->name", 400) ;
         }
         catch(Exception $e){
            error_log($e);
            return $this->errorResponse("Error al registrar producto en stock, verifique que exista el id del producto o la tienda", 400) ;
         }
      
         return $produstProvider;

         return $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = StoreResource::collection(Stores::all());
        return $this->paginate($store);
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
        $store = Stores::create(
            $request->all(),
        );
        return $this->showOne($store, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Stores $store)
    {
        return $this->showOne($store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stores $store)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $store->update($request->all());
        return $this->showOne($store);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stores $store)
    {
        $store->delete();
        return $this->showOne($store);
    }

    public function store_products(Request $request, Stores $store_id) {

        $store = Stores::where('id', $store_id->id)->first();

        $products_store = ProductStore::collection(Stock::where('store_id', $store_id->id)->get());

        $store_provider = [
            'store' => $store,
            'products' => $products_store
        ];

        return ($store_provider);
    }
}
