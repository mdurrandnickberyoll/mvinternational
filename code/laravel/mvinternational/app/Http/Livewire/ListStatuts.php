<?php

namespace App\Http\Livewire;

use App\Models\Statut;
use Livewire\Component;
use Livewire\WithPagination;

class ListStatuts extends Component
{
    use WithPagination;

    public $src_val;

    //afficher la vue du composant
    public function render()
    {
        return view('livewire.list-statuts', ['datas' => Statut::where('libelle', 'LIKE', "%{$this->src_val}%")->paginate(10)]);
    }
}
