<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class ShowProductos extends Component
{

    use WithPagination;
    

    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $open = false;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $listeners = ['render => render'];
    public function render()
    {
        // $productos= Producto::where('team_id','1')->get();
        // return view('livewire.show-productos', compact('productos'));

        $empresa=Auth::user()->currentTeam->id;

        // if ($search->isEmpty()){

        // $productos = Producto::where('team_id','=',$empresa)     
        //     ->orderBy($this->sort, $this->direction)
        //     ->get();
        // return view('livewire.show-productos', ['productos' => $productos]);
        // }
        // else{
        //     $productos = Producto::where('team_id','=',$empresa)
        //     ->Where('nombre', 'like', '%' . $this->search . '%')
        //     ->orWhere('sku_provee', 'like', '%' . $this->search . '%')         
        //     ->orderBy($this->sort, $this->direction)
        //     ->paginate(20);
        // return view('livewire.show-productos', ['productos' => $productos]);

        // }

    //     $productos = Producto::where('team_id','=',$empresa)
    //     ->Where('nombre', 'like', '%' . $this->search . '%')
    //     ->orWhere('sku_provee', 'like', '%' . $this->search . '%')         
    //     ->orderBy($this->sort, $this->direction)
    //     ->paginate(20);
    // return view('livewire.show-productos', ['productos' => $productos]);

        $productos = Producto::where('team_id','=',$empresa)
        ->when($this->search, function($query){
            return $query->where(function ($query){
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('sku_provee', 'like', '%' . $this->search . '%')         
                    ->orderBy($this->sort, $this->direction)
                    ->get();
            });
        });
        $query=$productos->toSql();
        $productos=$productos->paginate(100);
        
    return view('livewire.show-productos', [
        'productos'=>$productos,
        'query'=>$query
    ]);

    }
   

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
}
