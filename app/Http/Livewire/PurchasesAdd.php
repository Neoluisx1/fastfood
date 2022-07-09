<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Branchoffice;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\Product;

class PurchasesAdd extends Component
{
    //Datos publicos para poder guardar datos de un nuevo proveedor
    public $name = '', $phone = '', $address = '', $email = '', $selected_id = 0;

    public $search = '', $form = false, $date_register = '', $references = 0, $almacen_id = 0, $status = 0, $provider_id = 0, $product_id;

    public $componentName = '', $action = '', $more_options = false;

    public function render()
    {
        $references = Purchase::select('references')->orDerby('references','desc')->limit(10)->get();
        $this->date_register = date('d-m-Y h:i:s', time());
        $num = explode("/",$references);
        $num_atual = sprintf('%04d',(int)($num[2])+1);
        $this->references = 'COMPRA'.date('Y/d', time()).'/'.$num_atual;

        if(strlen($this->search) > 0){
            $products = Product::where('name','like',"%{$this->search}%")->get();
        }else{$products = [];}

        return view('livewire.purchasesadd.purchases-add',[
            'branchoffices' => Branchoffice::all(),
            'providers' => Provider::all(),
            'products' => $products,
        ])->layout('layouts.theme.app');
    }
    public function StoreNewP(){
        $this->validate(Provider::rules($this->selected_id),Provider::$messages);
        $provider = Provider::updateOrCreate(
            ['id' => $this->selected_id ],
            [
                'name' => $this->name,
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
            ]
        );
        $this->provider_id = $provider->id;
        $this->dispatchBrowserEvent('closeModalAddProvider');
        $this->noty($this->selected_id > 0 ? 'Proveedor Actualizado' : 'Proveedor Registrado', 'noty', true, 'listado');
    }

    public function noty($msg, $eventName = 'noty', $reset = true, $action = ''){
        $this->dispatchBrowserEvent($eventName,['msg' => $msg, 'type' => 'success', 'action' => $action]);
    }
    public $listeners = [
            'addProduct' => 'addProduct',
    ];
    public function addProduct($id){
        //agregar los datos para poder agregar los productos a la venta
        $this->search = null;

    }
}
