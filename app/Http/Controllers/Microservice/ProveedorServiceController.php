<?php

namespace App\Http\Controllers\Microservice;

use App\Http\Controllers\Controller;
use App\Service\ProveedorService;
use Illuminate\Http\Request;

class ProveedorServiceController extends Controller
{
    public $proveedorService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( ProveedorService $proveedorService)
    {
        $this->proveedorService = $proveedorService;
    }

    public function index()
    {
       return $this->successDataService($this->proveedorService->getProveedorIndex());
    }

    public function show($Proveedor_id)
    {
        return $this->successDataService($this->proveedorService->getProveedorShow($Proveedor_id));
    }
    public function store(Request $request)
    {
        // validacion de tienda y producto
        // $validacion =  $this->successDataService($this->authorService->getAuthor($request->author_id));
        
        return $this->successDataService($this->proveedorService->createProveedor($request->all()));
    }
    public function update(Request $request, $Proveedor_id)
    {
        return $this->successDataService($this->proveedorService->editProveedor($request->all(), $Proveedor_id));
    }
    public function destroy($Proveedor_id)
    {
        // return "hola elim";  
        return $this->successDataService($this->proveedorService->deleteProveedor($Proveedor_id));
    }
}
