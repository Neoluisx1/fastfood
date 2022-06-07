<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; //subir imagenes

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $name = '',
            $code = '', 
            $cost = 0, 
            $price = 0, 
            $price2 = 0, 
            $stock = 0, 
            $minstock = 0, 
            $category_id = 'Elegir', 
            $selected_id = 0,
            $temporaryUrl,
            $gallery = [];
    public $action = 'Listado', $componentName = 'Catalogo de productos', $search, $form = false;
    private $pagination = 5;
    protected $paginationtheme = 'tailwind';

    public function render()
    {
        if(strlen($this->search > 0))
        $info = Product::join('categories as c','c.id', 'products.category_id')->select('products.*','c.name as category')->where('products.name')
                ->orwhere('products.name','like',"%{$this->search}%")
                ->orwhere('products.code','like',"%{$this->search}%")
                ->orwhere('c.name','like',"%{$this->search}%")
                ->paginate($this->pagination);
        else
        $info = Product::join('categories as c','c.id', 'products.category_id')->select('products.*','c.name as category')               
                ->paginate($this->pagination);
        return view('livewire.products.component',[
            'products' => $info,
            'categories' => Category::orderBy('name', 'asc')->get()
        ])->layout('layouts.theme.app');
    }

    public $listeners = [
        'resetUI',
        'Destroy'
    ];
    public function noty($msg, $eventName = 'Noty', $reset = true, $action = ''){
        $this->dispatchBrowserEvent($eventName, ['msg' => $msg, 'type' => 'success', 'action' => $action]);
        if($reset) $this->resetUI();
    }
    public function AddNew(){
        $this->resetUI();
        $this->noty(null, 'open-modal');
    }
    public function resetUI(){
        $this->resetValidation();
        $this->resetPage();
        $this->reset('name','code','cost','price','price2','stock','minstock','selected_id','search','action','gallery');
    }
    public function CloseModal(){
        $this->resetUI();
        $this->noty(null, 'close-modal');
    }
    public function Edit(Product $product){
        $this->selected_id = $product->id;
        $this->name = $product->name;
        $this->codigo = $product->codigo;
        $this->cost = $product->cost;
        $this->price = $product->price;
        $this->price2 = $product->price2;
        $this->stock = $product->stock;
        $this->minstock = $product->minstock;
        $this->category_id = $product->category_id;
        $this->noty('','open-modal', false);
    }
    public function Store(){
        sleep(1);
        $this->validate(Product::rules($this->selected_id),Product::$messages);

        $product = Product::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'name' => $this->name,
                'code' => $this->code,
                'cost' => $this->cost,
                'price' => $this->price,
                'price2' => $this->price2,
                'stock' => $this->stock,
                'minstock' => $this->minstock,
                'category_id' => $this->category_id,
            ]
        );
        if(!empty($this->gallery)){
            if($this->selected_id > 0){
                //borrar todas las imagenes fisicamente
                $product->images()->each(function($img){
                    if($img->file != null && file_exists('storage/products/' . $img->file)){
                        unlink('storage/products/' . $img->file);
                    }
                });
                $product->images()->delete();
            }
            foreach($this->gallery as $photo){
                $customFileName = uniqid() . '_.' . $photo->extension();
                $photo->storeAs('public/products',$customFileName);
                //create imagen dentro del modelo de imagenes
                $img = Image::create([
                    'model_id' => $product->id,
                    'model_type' => 'App\Models\Product',
                    'file' => $customFileName
                ]);
                $product->images()->save($img);
            }
        }
        $this->noty($this->selected_id > 0 ? 'Producto Actualizado': 'Producto Registrado', 'noty', false, 'close-modal');
        $this->resetUI();
    }
    public function Destroy(Product $product){
        $product->images()->each(function ($img){
            if($img->file != null && file_exists('storage/products/' . $img->file)){
                unlink('storage/procuts/' . $img->file);
            }
        });
        //Eliminar las relaciones
        $product->images()->delete();
        // Eliminar le producto
        $product->delete();

        $this->noty('Se Elimino el Producto');
    }
}
