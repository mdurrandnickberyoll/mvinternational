<?php

namespace App\Http\Livewire;

use App\Models\GroupeBatisseurJour;
use Livewire\Component;
use Livewire\WithPagination;

class ListGroupeBatisseurJour extends Component
{
    use WithPagination;
    public $src_val;
    public $groupe_batisseur;

    public function mount($groupe_batisseur)
    {
        $this->groupe_batisseur = $groupe_batisseur;
    }
    public function render()
    {

        return view('livewire.list-groupe-batisseur-jour', [
            'datas' => GroupeBatisseurJour::join('jours', 'groupe_batisseur_jours.jour_id', '=', 'jours.id')
                ->select('groupe_batisseur_jours.*', 'jours.libelle')
                ->where('groupe_batisseur_jours.groupe_batisseur_id',$this->groupe_batisseur->id)
                ->where(function ($query) {
                    $query
                    ->where('jours.libelle', 'LIKE', "%{$this->src_val}%")
                    ->orwhere('jours.created_at', 'LIKE', "%{$this->src_val}%");
                })->paginate(10)
        ]);
    }
}
