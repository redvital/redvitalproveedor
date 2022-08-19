<?php

namespace App\Http\Controllers;
use App\Models\Team;
use App\Models\User;
use App\Models\Data_proveedores;

use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public $teams;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $teams = Team::all();
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required',
            'email' =>'required|unique:user',
            'empresa'=>'required|unique:user',
            'rif' => 'required|unique:user',
            'direccion' =>'required'
        ]);
        
        User::create([
            'name'=>$request->name, 
            'email'=>$request->mail,
            'role'=>'user',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       
        $teams = Team::all();
      
        return view('admin.lista-proveedores',compact('teams'));
            
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
