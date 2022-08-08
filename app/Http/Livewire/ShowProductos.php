<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ShowProductos extends Component
{
    public $search;
    public $sort='id';
    public $direction='desc';

    public function render()
    {
        // $productos = Producto::all();
        $productos = Product::where('name','like','%'. $this-> search .'%')
        ->orWhere('sku_provider','like','%'. $this-> search .'%')
        ->orderBy($this->sort, $this->direction)
        ->get();
        return view('livewire.show-productos',compact('productos'));
    }

    public function order($sort){
        if($this->sort==$sort){
            if($this->direction=='desc'){
                $this->direction='asc';
               }   else {
                    $this->direction='desc';
                }
            }else{
                $this->sort = $sort;
                $this->direction = 'asc';
            }
        }

    }
