<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public $form=false, $name='',$selected_id=0,$photo='';
    public $action='Listado', $componentName='Categorias',$search='';
    private $pagination = 5;
    protected $paginationTheme='talwind';
    public function render()
    {
        if(strlen($this->search)>0)
        $info=Category::where('name','like',"%{$this->search}%")->paginate($this->pagination);
        else
        $info=Category::orderBy('name','asc')->paginate($this->pagination);
        return view('livewire.categories.component',['categories' => $info])
                ->layout('layouts.theme.app');
    }

    public function Edit(Category $category){
        $this->selected_id = $category->id;
        $this->name = $category->name;
        $this->form = true;

    }
    public function noty($msg, $eventName = 'Noty', $reset = true, $action = ''){
        $this->dispatchBrowserEvent($eventName, ['msg' => $msg, 'type' => 'success', 'action' => $action]);
        if($reset) $this->resetUI();
    }

    public function AddNew(){
        $this->resetUI();
        $this->form=true;
        $this->action = 'Agregar';
    }
    public function CloseModal(){
        $this->resetUI();
        $this->noty(null,'close-modal');
    }
    public function resetUI(){
        $this->resetPage();
        $this->resetValidation();
        $this->reset('name', 'selected_id', 'search', 'form' );
    }

    public $listeners=['resetUI', 'Destroy'];

    public function Store(){
        $this->validate(Category::rules($this->selected_id), Category::$messages);

        Category::updateOrCreate(['id'=>$this->selected_id],[
            'name'=>$this->name,

        ]);

        $this->noty($this->selected_id > 0 ? 'CAtegoria Actualizado' : 'Categoria Registrada' , 'noty', false, 'close-modal');
        $this->resetUI();
    }
    public function Destroy(Category $category){
        if($category->orders->count()<1){
            $category->delete();
            $this->noty("El cliente <b>$category->name</b> fue eliminado");
        }
        else{
            $this->noty("El clietne tiene ventas relacioandas no se puede eliminar");
        }
    }
}
