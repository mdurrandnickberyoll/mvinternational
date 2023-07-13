<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-users',[
            'datas' => User::where(function ($query) {
            $query->where('name', 'LIKE', "%{$this->src_val}%")
                ->orWhere('prenom', 'LIKE', "%{$this->src_val}%")
                ->orWhere('adresse', 'LIKE', "%{$this->src_val}%")
                ->orWhere('telephone', 'LIKE', "%{$this->src_val}%");
        })->paginate(10) ]);
    }
}
