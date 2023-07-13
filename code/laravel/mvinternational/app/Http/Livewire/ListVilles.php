<?php

namespace App\Http\Livewire;

use App\Models\Ville;
use Livewire\Component;
use Livewire\WithPagination;

class ListVilles extends Component
{
    use WithPagination;

    public $src_val;

    //afficher la vue du composant
    public function render()
    {
        return view('livewire.list-villes', ['datas' => Ville::where('libelle', 'LIKE', "%{$this->src_val}%")->paginate(10)]);
    }
}
