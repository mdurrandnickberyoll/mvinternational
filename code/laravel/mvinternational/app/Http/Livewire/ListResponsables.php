<?php

namespace App\Http\Livewire;

use App\Models\Responsable;
use Livewire\Component;
use Livewire\WithPagination;

class ListResponsables extends Component
{
    use WithPagination;

    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-responsables',[
            'datas' => Responsable::where(function ($query) {
            $query->where('nom', 'LIKE', "%{$this->src_val}%")
                ->orWhere('prenom', 'LIKE', "%{$this->src_val}%")
                ->orWhere('adresse', 'LIKE', "%{$this->src_val}%")
                ->orWhere('telephone', 'LIKE', "%{$this->src_val}%");
        })->paginate(10) ]);
    }
}
