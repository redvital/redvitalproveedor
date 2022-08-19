<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Livewire\ShowProductos;

class ProductoController extends Controller
{
    public function index(){
        $productos= Producto::where('team_id',1)->get();

        return view('livewire.show-productos', compact('productos'));
    }
    
    public function AdminListProduct(){
        $productos= Producto::where('team_id',1)->get();

        return view('admin.lista-productos', compact('productos'));
    }
}
