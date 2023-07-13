<?php

namespace App\Http\Livewire;

use App\Models\Etape;
use Livewire\Component;
use Livewire\WithPagination;

class ListEtapes extends Component
{
    use WithPagination;

    public $src_val;

    public $workflow;

    //public function init($workflow)

    public function mount($workflow)
    {
        $this->workflow = $workflow;
    }
  
    //afficher la vue du composant
    public function render()
    {    
        return view('livewire.list-etapes',['datas' => Etape::where('workflow_id',$this->workflow->id)
        ->where('libelle','LIKE',"%{$this->src_val}%")
        //->orWhere('sequence','LIKE',"%{$this->src_val}%")
        ->paginate(10)]);
    } 
}
