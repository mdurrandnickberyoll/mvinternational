<?php

namespace App\Http\Livewire;

use App\Models\Entreprise;
use Livewire\Component;
use Livewire\WithPagination;

class ListEntreprises extends Component
{
    use WithPagination;
    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-entreprises',[
            'datas' => Entreprise::where(function ($query) {
            $query->where('nom', 'LIKE', "%{$this->src_val}%")
                ->orWhere('description', 'LIKE', "%{$this->src_val}%");
        })->paginate(10) ]);
    }
}
