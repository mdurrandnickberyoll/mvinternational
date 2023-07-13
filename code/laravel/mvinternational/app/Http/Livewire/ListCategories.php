<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategories extends Component
{

    use WithPagination;
    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-categories',[
            'datas' => Categorie::where(function ($query) {
            $query->where('libelle', 'LIKE', "%{$this->src_val}%")
                ->orWhere('icone', 'LIKE', "%{$this->src_val}%");
        })->paginate(10) ]);
    }
}
