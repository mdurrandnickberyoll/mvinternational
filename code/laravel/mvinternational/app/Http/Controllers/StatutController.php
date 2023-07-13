<?php

namespace App\Http\Controllers;

use App\Models\Statut;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StatutController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.parametrage.';

    /**
     * afficher la liste des statuts
     */
    public function index()
    {
        return view($this->module_path . 'statuts');
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create()
    {
        return view($this->module_path . 'statut');
    }

    /**
     * enregistrer une information dans la base de données
     */
    public function store(Request $request)
    {
        //cas de la création 
        if (empty($request->id)) {
            //validation des données lors de la sauvegarde
            $request->validate([
                'libelle' => [
                    'required', 
                    'min:3', 
                    Rule::unique('statuts')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
            ]);

            //persistence dans la base
            $statut = new Statut();
            $statut->libelle = $request->libelle;
            $statut->description = $request->description;

            $statut->save();
        } //cas de la suppression
        elseif (!empty($request->supp)) {
            $this->destroy($request->id);
        }
        //cas de la modification
        else {
            //validation des données lors de la sauvegarde
            $request->validate([
                'id' => ['required'],
                'libelle' => ['required', 'min:3']
            ]);

            $this->update($request);
        }

        return redirect('/statuts');
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $statut = Statut::findOrfail($id);
        return view($this->module_path . 'statut', compact('statut'));
    }

    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $statut = Statut::findOrfail($id);
        return view($this->module_path . 'statut', compact('statut', 'supp'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $statut = Statut::findOrfail($request->id);

        $statut->libelle = $request->libelle;
        $statut->description = $request->description;

        //mise à jour des informations
        $statut->save();

        return redirect('/statuts');
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        Statut::find($id)->delete();
    }
}
