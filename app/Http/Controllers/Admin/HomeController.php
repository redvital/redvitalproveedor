<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['only'=>'admin']);
    }

    public function index(){
        $teams = Team::all();
        $productos = Producto::all();
        return view('admin.index',compact('teams', 'productos'));
    }

    public function userpro(){
        return view('dashboard');
    }
}
