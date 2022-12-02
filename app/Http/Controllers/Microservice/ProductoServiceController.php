<?php

namespace App\Http\Controllers\Microservice;

use App\Http\Controllers\Controller;
use App\Service\ProductoService;
use Illuminate\Http\Request;

class ProductoServiceController extends Controller
{
    public $productoService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index()
    {
       return $this->successDataService($this->productoService->getProductoIndex());
    }

    public function show($Tienda_id)
    {
        return $this->successDataService($this->productoService->getProductoShow($Tienda_id));
    }
    public function store(Request $request)
    {
        // validacion de tienda y producto
        // $validacion =  $this->successDataService($this->authorService->getAuthor($request->author_id));
        
        return $this->successDataService($this->productoService->createProducto($request->all()));
    }
    public function update(Request $request, $Tienda_id)
    {
        return $this->successDataService($this->productoService->editProducto($request->all(), $Tienda_id));
    }
    public function destroy($Tienda_id)
    {
        return $this->successDataService($this->productoService->deleteProducto($Tienda_id));
    }
}
