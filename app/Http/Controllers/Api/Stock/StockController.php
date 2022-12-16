<?php

namespace App\Http\Controllers\Api\Stock;

use Exception;
use App\Models\Stock;
use App\Models\Stores;
use App\Models\Product;
use App\Models\Provider;
use App\Traits\AuthUser;
use Illuminate\Http\Request;
use App\Models\ProductProvider;
use App\Http\Controllers\Controller;
use App\Http\Resources\StockResource;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class StockController extends Controller
{use AuthUser;
    private $requestFilterSupplier = '';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'quantity' => 'required',
        'product_id' => 'required'
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
        $validateStore =  Stores::findOrFail($store);
        Product::findOrFail($product);
        Provider::findOrFail($provider);
        try{
           $produstProvider = ProductProvider::where('product_id', $product)->where('provider_id',$provider)->first();
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
              
               return $this->errorResponse("Error, el producto ya se encuentra registrado en stock de la tienda: $validateStore->name", 400) ;
           }
           return $this->errorResponse("Error, el producto no coincide con el proveedor", 400);
           // return $produstProvider;
        
        
        }
        catch(Exception $e){
           error_log($e);
           
           return $this->errorResponse("Error al registrar producto en stock, verifique que exista el id del producto o la tienda", 400) ;
        }
   }

   public function list_stock(Request $request, Stores $store_id){

    $data= $store_id->stock()->with('productProviders.provider', 'productProviders.product')->get()->pluck('productProviders')->values();
    $userInfo = $this->infoUserMe();
    if ($userInfo->role == "client") 
    {
        if(is_null($userInfo->providerUserMe))
        {
           return $this->errorResponse("Debe tener un proveedor registrado",400);
        };
       $collation = $data->filter(function($element)
       {
        error_log($element->provider_id);
        error_log($this->infoUserMe()->providerUserMe->id);
        $result = $element->provider_id == $this->infoUserMe()->providerUserMe->id;
        return $result;
        
         return $element == $this->infoUserMe()->providerUserMe->id;
       });
       return $this->showAll($collation);
    }

if($userInfo->role == "admin"){
    $this->requestFilterSupplier = $request->query("supplier");
    if(empty($this->requestFilterSupplier)){
        return $this->showAll($data);
    }
    Provider::findOrFail($this->requestFilterSupplier);
    $filterforquery=  $data->filter(function($element){
        return $element->provider_id == $this->requestFilterSupplier;
    })->values(); 
     return $this->showAll($filterforquery);
    
}
   
}
    public function index(Request $request)
    {
        $query = $request->query();

        if( !empty($query)){
            list('store' => $store, 'supplier_id' => $supplier) = $query;
            if($store  && $supplier ){
                $stock_data = StockResource::collection(Stock::all()->where('store_id', $store)->where('supplier_id', $supplier));
            }else if ($store > 0){
                $stock_data = StockResource::collection(Stock::all()->where('store_id', $store));
            }else if ($supplier > 0){
                $stock_data = StockResource::collection(Stock::all()->where('supplier_id', $supplier));
            }
        } else {
            $stock_data = StockResource::collection(Stock::all());
        }

        $stock = $this->paginate($stock_data);
        return $stock;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Stores $store_id, Provider $supplier_id)
    {
        $validate = Validator::make($request->all(), $this->rules);

        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }

        $stock = Stock::create(
            [
                'quantity' => $request->quantity,
                'product_id' => $request->product_id,
                'store_id' => $store_id->id,
                'supplier_id' => $supplier_id->id
            ]
        );

        return $this->showOne($stock, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Stock $stock_id)
    {
        $stock =  Stock::findOrFail($stock_id->id);
        return $this->showOne($stock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock_id)
    {
        $stock_id->fill($request->all());
        if($stock_id->isClean())
        {
            return $this->errorResponse("Al menos un valor debe cambiar" , Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $stock_id->save();
        return $this->showOne($stock_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($stock_id)
    {
        $stock = Stock::findOrFail($stock_id);
        $stock->delete();

        return $this->showOne($stock);
    }
}
