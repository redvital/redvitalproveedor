<?php

namespace App\Http\Controllers\Microservice;

use App\Http\Controllers\Controller;
use App\Service\TiendaService;
use Illuminate\Http\Request;

class TiendaServiceController extends Controller
{
    public $tiendaService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( TiendaService $tiendaService)
    {
        $this->tiendaService = $tiendaService;
    }

    public function index()
    {
       return $this->successDataService($this->tiendaService->getTiendaIndex());
    }

    public function show($Tienda_id)
    {
        return $this->successDataService($this->tiendaService->getTiendaShow($Tienda_id));
    }
    public function store(Request $request)
    {
        // validacion de tienda y producto
        // $validacion =  $this->successDataService($this->authorService->getAuthor($request->author_id));
        error_log("hola");
        return $this->successDataService($this->tiendaService->createTienda($request->all()));
    }
    public function update(Request $request, $Tienda_id)
    {
        return $this->successDataService($this->tiendaService->editTienda($request->all(), $Tienda_id));
    }
    public function destroy($Tienda_id)
    {
        return $this->successDataService($this->tiendaService->deleteTienda($Tienda_id));
    }
}
