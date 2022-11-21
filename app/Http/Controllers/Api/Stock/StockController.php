<?php

namespace App\Http\Controllers\Api\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Stores;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\StockResource;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'quantity' => 'required',
        'product_id' => 'required'
    ];

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
    public function update(Request $request, Stores $store_id, Provider $supplier_id, Stock $stock_id)
    {
        $validate = Validator::make($request->all(), $this->rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_BAD_REQUEST);
        }

        $stock = Stock::findOrFail($stock_id->id);

        $stock->update(
            [
                'quantity' => $request->quantity,
                'product_id' => $request->product_id,
                'store_id' => $store_id->id,
                'supplier_id' => $supplier_id->id
            ]
        );

        return $this->showOne($stock);
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
