<?php

namespace App\Http\Livewire;

use App\Models\Organisation;
use Livewire\Component;
use Livewire\WithPagination;

class ListOrganisations extends Component
{
    use WithPagination;

    public $src_val;

    //afficher la vue du composant
    public function render()
    {
        return view('livewire.list-organisations', ['datas' => Organisation::with('typeOrganisation')->where('libelle', 'LIKE', "%{$this->src_val}%")->paginate(10)]);

    }
}