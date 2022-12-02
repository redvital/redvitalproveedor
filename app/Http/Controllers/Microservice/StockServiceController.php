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
        error_log("hola");
       return $this->successDataService($this->stockService->getStockIndex());
    }
}
