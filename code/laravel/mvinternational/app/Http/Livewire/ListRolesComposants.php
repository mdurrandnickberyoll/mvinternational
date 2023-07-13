<?php

namespace App\Http\Livewire;

use App\Models\RoleComposant;
use Livewire\Component;
use Livewire\WithPagination;

class ListRolesComposants extends Component
{
    use WithPagination;

    public $src_val;

    public $role;

    //public function init($workflow)

    public function mount($role)
    {
        $this->role = $role;
    }
  
    //afficher la vue du composant
    public function render()
    {    
        return view('livewire.list-roles-composants',['datas' => RoleComposant::where('role_id',$this->role->id)
        //->where('libelle','LIKE',"%{$this->src_val}%")
        //->orWhere('sequence','LIKE',"%{$this->src_val}%")
        ->paginate(10)]);
    }  
}
