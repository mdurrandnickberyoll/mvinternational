<?php

namespace App\Http\Livewire;


use App\Models\Groupe;
use Livewire\Component;
// use Livewire\WithPagination;

class ListGroupe extends Component
{
    // use WithPagination;
    public $src_val;
    public function render()
    {
        return view('livewire.list-groupe', ['datas' => Groupe::where('libelle','LIKE',"%{$this->src_val}%")->get() ]);
    }
}
