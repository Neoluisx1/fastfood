<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sales extends Component
{
    public $customerSelected = 'Seleccionar Cliente',$itemsCart,$totalCart;
    public function render()
    {
        return view('livewire.sales.component')->layout('layouts.theme.app');
    }
}
