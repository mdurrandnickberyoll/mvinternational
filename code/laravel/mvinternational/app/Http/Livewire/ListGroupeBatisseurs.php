<?php

namespace App\Http\Livewire;

use App\Models\GroupeBatisseur;
use Livewire\Component;
use Livewire\WithPagination;

class ListGroupeBatisseurs extends Component
{
    use WithPagination;

    public $src_val;
    public $batisseur;

    public function mount($batisseur)
    {
        $this->batisseur = $batisseur;
    }
    public function render()
    {

        return view('livewire.list-groupe-batisseurs', [
            'datas' => GroupeBatisseur::join('groupes', 'groupe_batisseurs.groupe_id', '=', 'groupes.id')
                ->select('groupe_batisseurs.*', 'groupes.libelle')
                ->where('groupe_batisseurs.batisseur_id',$this->batisseur->id)
                ->where(function ($query) {
                    $query
                    ->where('groupes.libelle', 'LIKE', "%{$this->src_val}%")
                    ->orwhere('groupes.created_at', 'LIKE', "%{$this->src_val}%");
                })->paginate(10)
        ]);
    }
}
