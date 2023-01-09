<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Livewire\ShowProductos;

class ProductoController extends Controller
{
    public function index(){
        $productos= Product::where('team_id',1)->get();

        return view('livewire.show-productos', compact('productos'));
    }
    
    public function AdminListProduct(){
        $productos= Product::where('team_id',1)->get();

        return view('admin.lista-productos', compact('productos'));
    }
}
