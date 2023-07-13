<?php

namespace App\Http\Livewire;

use App\Models\Pays;
use Livewire\Component;
use Livewire\WithPagination;

class ListPays extends Component
{
    use WithPagination;

    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-pays',['datas' => Pays::where('libelle','LIKE',"%{$this->src_val}%")->paginate(10)]);
    } 
}
