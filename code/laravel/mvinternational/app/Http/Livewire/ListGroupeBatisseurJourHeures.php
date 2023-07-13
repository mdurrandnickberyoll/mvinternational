<?php

namespace App\Http\Livewire;

use App\Models\GroupeBatisseurJourHeure;
use Livewire\Component;
use Livewire\WithPagination;

class ListGroupeBatisseurJourHeures extends Component
{
    use WithPagination;
    public $src_val;
    public $groupe_batisseur_jour;

    public function mount($groupe_batisseur_jour)
    {
        $this->groupe_batisseur_jour = $groupe_batisseur_jour;
    }
    public function render()
    {

        return view('livewire.list-groupe-batisseur-jour-heures', [
            'datas' => GroupeBatisseurJourHeure::join('heures', 'groupe_batisseur_jour_heures.heure_id', '=', 'heures.id')
                ->select('groupe_batisseur_jour_heures.*', 'heures.libelle')
                ->where('groupe_batisseur_jour_heures.groupe_batisseur_jour_id',$this->groupe_batisseur_jour->id)
                ->where(function ($query) {
                    $query
                    ->where('heures.libelle', 'LIKE', "%{$this->src_val}%")
                    ->orwhere('heures.created_at', 'LIKE', "%{$this->src_val}%");
                })->paginate(10)
        ]);
    }
}
