<?php

namespace App\Http\Livewire;

use App\Models\Parametre;
use Livewire\Component;
use Livewire\WithPagination;

class ListParametres extends Component
{
    use WithPagination;

    public $src_val;

    public function render()
    {
        return view('livewire.list-parametres', ['datas' => Parametre::where('valeur', 'LIKE', "%{$this->src_val}%")->paginate(10)]);
    }
}
