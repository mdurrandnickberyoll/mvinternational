<?php

namespace App\Http\Livewire;

use App\Models\Temoignage;
use Livewire\Component;
use Livewire\WithPagination;

class ListTemoignage extends Component
{
    use WithPagination;
    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-temoignage',[
            'datas' => Temoignage::where(function ($query) {
            $query->where('nom', 'LIKE', "%{$this->src_val}%")
                ->orWhere('profession', 'LIKE', "%{$this->src_val}%")
                ->orWhere('content', 'LIKE', "%{$this->src_val}%");
        })->get()]);
    }
}
