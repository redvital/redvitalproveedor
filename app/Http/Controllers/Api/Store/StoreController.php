<?php

namespace App\Http\Controllers\Api\Store;

use Exception;
use App\Models\Stock;
use App\Models\Stores;
// use App\Models\Product;
// use App\Models\Provider;
// use App\Traits\AuthUser;
use Illuminate\Http\Request;
use App\Models\ProductProvider;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductStore;
// use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StoreResource;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    
    private $rules = [
        'name' => 'required',
        'code' => 'required',

    ];


    
    
    

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
        // todo:add valitation
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
        $store->fill($request->all());
        if($store->isClean())
        {
            return $this->errorResponse("Al menos un valor debe cambiar" , Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $store->save();
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
// update product