<?php

namespace App\Http\Livewire;

use App\Models\Heure;
use Livewire\Component;
use Livewire\WithPagination;

class ListHeures extends Component
{
    use WithPagination;

    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-heures',['datas' => Heure::where('libelle','LIKE',"%{$this->src_val}%")->get()]);
    } 
}
