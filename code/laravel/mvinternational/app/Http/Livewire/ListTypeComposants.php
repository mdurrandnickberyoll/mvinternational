<?php

namespace App\Http\Livewire;

use App\Models\TypeComposant;
use Livewire\Component;
use Livewire\WithPagination;

class ListTypeComposants extends Component
{
    use WithPagination;

    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-type-composants',['datas' => TypeComposant::where('libelle','LIKE',"%{$this->src_val}%")->paginate(10) ]);
    } 
}
