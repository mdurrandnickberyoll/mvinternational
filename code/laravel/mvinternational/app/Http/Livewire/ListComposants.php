<?php

namespace App\Http\Livewire;

use App\Models\Composant;
use Livewire\Component;
use Livewire\WithPagination;

class ListComposants extends Component
{
    use WithPagination;

    public $src_val;

    public function render()
    {
        return view('livewire.list-composants', ['datas' => Composant::where('libelle', 'LIKE', "%{$this->src_val}%")->paginate(10)]);
    }
}