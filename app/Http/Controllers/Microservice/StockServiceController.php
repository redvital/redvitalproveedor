<?php

namespace App\Http\Controllers\Microservice;

use App\Http\Controllers\Controller;
use App\Service\StockForStoreService;
use Illuminate\Http\Request;

class StockServiceController extends Controller
{
    public $stockService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( StockForStoreService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index()
    {
       return $this->successDataService($this->stockService->getStockIndex());
    }

    public function show($Stock_id)
    {
        return $this->successDataService($this->stockService->getStockShow($Stock_id));
    }
    public function store(Request $request)
    {
        return $this->successDataService($this->stockService->createStock($request->all(), $formaParams = $request->query->all()));
    }
    public function update(Request $request, $Stock_id)
    {
        return $this->successDataService($this->stockService->editStock($request->all(), $Stock_id));
    }
    public function destroy($Stock_id)
    {
        return $this->successDataService($this->stockService->deleteStock($Stock_id));
    }
}
