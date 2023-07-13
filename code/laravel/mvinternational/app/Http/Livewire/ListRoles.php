<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class ListRoles extends Component
{
    use WithPagination;

    public $src_val;

    //afficher la vue du composant
    public function render()
    {
        return view('livewire.list-roles', ['datas' => Role::where('libelle', 'LIKE', "%{$this->src_val}%")->paginate(10)]);
    }
}
