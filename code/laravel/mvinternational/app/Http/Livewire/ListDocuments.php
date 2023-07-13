<?php

namespace App\Http\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;

class ListDocuments extends Component
{
    use WithPagination;

    public $src_val;
  
    //afficher la vue du composant
    public function render()
    {   
        return view('livewire.list-documents',['datas' => Document::where('libelle','LIKE',"%{$this->src_val}%")
        ->orWhere('codeInterne','LIKE',"%{$this->src_val}%")
        ->paginate(10) ]);
    }
}
