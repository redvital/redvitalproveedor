<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PrincipalAdmin extends Component
{
    public function render()
    {
        return view('livewire.principal-admin');
    }
}
