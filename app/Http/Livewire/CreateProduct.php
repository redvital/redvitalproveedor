<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Movimiento;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;


class CreateProduct extends Component
{
    
    public $open = false;

    use WithFileUploads;


    public $id1, $sku_provee, $barras, $nombre, $cantidad_empaque, $cantidad, $condicion, $moneda, $cbulto, $cunidad, $psugerido, $user_id, $imagen, $identificador,$categoria;
    // protected $listener = ['render'=>'render'];

    public function mount()
    {
        $this->identificador = rand();
    }
  

    protected $messages = [
        'required' => 'Error :Valor requerido.',
        'size' => 'The :attribute must be exactly :size.',
        'between' => 'The :attribute value :input is not between :min - :max.',
        'in' => 'The :attribute must be one of the following types: :values',
    ];
    protected $rules = [
        'sku_provee' => 'required|unique:productos',
        'barras' => 'required',
        'nombre' => 'required',
        'cantidad_empaque' => 'required',
        'condicion' => 'required',
        'moneda' => 'required',
        'cantidad' => 'required',
        'cbulto' => 'required',
        'cunidad' => 'required',
        'psugerido' => 'required',
        'imagen' => 'image|max:2048'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {

        $this->validate();
        $imagen = $this->imagen->store('productos');

        Producto::create([
            'sku_provee' => $this->sku_provee,
            'barras' => $this->barras,
            'nombre' => $this->nombre,
            'cantidad_empaque' => $this->cantidad_empaque,
            'status' => "N",
            'user_id' => $id = Auth::user()->currentTeam->id,
            'team_id' => $idteam =Auth::id(),
            'imagen' => $imagen,
            'condicion' => $this->condicion,
            'moneda' => $this->moneda,
            'cantidad' => $this->cantidad,
            'cbulto' => $this->cbulto,
            'cunidad' => $this->cunidad,
            'psugerido' => $this->psugerido,
            'categoria' => $this->categoria,
        ]);

        Movimiento::create([
            'sku_provee' => $this->sku_provee,
            'condicion' => $this->condicion,
            'moneda' => $this->moneda,
            'cantidad' => $this->cantidad,
            'cbulto' => $this->cbulto,
            'cunidad' => $this->cunidad,
            'psugerido' => $this->psugerido
        ]);

        $this->reset(['open', 'sku_provee', 'barras', 'nombre', 'cantidad_empaque', 'cantidad', 'condicion', 'moneda', 'cbulto', 'cunidad', 'psugerido', 'user_id', 'imagen']);

        $this->identificador = rand();
        $this->emitTo('show-productos', 'render');
        $this->emit('alert', 'El Producto se creo satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}
