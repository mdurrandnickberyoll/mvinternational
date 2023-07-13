<?php

namespace App\Http\Livewire;

use App\Models\TypeOrganisation;
use Livewire\Component;
use Livewire\WithPagination;

class ListTypeOrganisations extends Component
{
    use WithPagination;
    public $src_val;
    public function render()
    {
        return view('livewire.list-type-organisations', ['datas' => TypeOrganisation::where('libelle','LIKE',"%{$this->src_val}%")->paginate(10) ]);
    }
}
