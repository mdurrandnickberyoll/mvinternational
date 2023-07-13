<?php

namespace App\Http\Livewire;

use App\Models\TrancheAge;
use Livewire\Component;
use Livewire\WithPagination;

class ListTrancheAges extends Component
{
    use WithPagination;
    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-tranche-ages',['datas' => TrancheAge::where('libelle','LIKE',"%{$this->src_val}%")->get()]);
    } 
}
