<?php

namespace App\Http\Livewire;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;

class ListGenres extends Component
{
    use WithPagination;
    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-genres',['datas' => Genre::where('libelle','LIKE',"%{$this->src_val}%")->get()]);
    } 
}
