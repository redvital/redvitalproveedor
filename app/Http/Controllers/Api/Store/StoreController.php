<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Models\Stores;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ProductStore;
use App\Http\Resources\StoreProviderResource;
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
        $store = Stores::all();
        return $this->showAll($store);
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

        $products_store = StoreProvider::collection(Stock::where('store_id', $store_id->id)->get());

        $store_provider = [
            'store' => $store,
            'products' => $products_store
        ];

        return ($store_provider);
    }

    public function store_providers(Request $request, Stores $store_id) {

        $store = Stores::where('id', $store_id->id)->first();

        $provider_store = StoreProviderResource::collection(Stock::where('store_id', $store_id->id)->get());

        $store_provider = [
            'store' => $store,
            'providers' => $provider_store
        ];
        return ($store_provider);
    }
}
