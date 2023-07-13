<?php

namespace App\Http\Livewire;

use App\Models\Jour;
use Livewire\Component;
// use Livewire\WithPagination;

class ListJours extends Component
{
    // use WithPagination;

    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-jours',['datas' => Jour::where('libelle','LIKE',"%{$this->src_val}%")->get()]);
    } 
}
