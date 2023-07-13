<?php

namespace App\Http\Livewire;

use App\Models\Workflow;
use Livewire\Component;
use Livewire\WithPagination;

class ListWorkflows extends Component
{
    use WithPagination;

    public $src_val;

    //afficher la vue du composant
    public function render()
    {
        return view('livewire.list-workflows', ['datas' => Workflow::where('libelle', 'LIKE', "%{$this->src_val}%")->paginate(10)]);
    }
}
