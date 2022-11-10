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

    public function index(Request $request, Stores $store_id ,Provider $supplier_id)
    {
        $stock_data = StockResource::collection(Stock::where('store_id', $store_id->id)->where('supplier_id', $supplier_id->id)->get());

        $stock = $this->paginate($stock_data);

        $provider = Provider::where('id',$request->supplier_id->id)->first();

        $store = Stores::where('id', $request->store_id->id)->first();

        $store_provider = [
            'stock_data' => $stock,
            'provider' => $provider,
            'store' => $store
        ];

        return $store_provider;
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
