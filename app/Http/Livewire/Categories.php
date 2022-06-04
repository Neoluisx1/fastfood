<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public $form=false, $name='',$selected_id=0,$photo='';
    public $qction='Litado', $componentName='Categorias',$search='';
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

    }
}
