<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Movimiento;
use Livewire\WithFileUploads;


class ExampleComponent extends \Livewire\Component 

{

public function render()
{
    return view('livewire.create-product');
}
}