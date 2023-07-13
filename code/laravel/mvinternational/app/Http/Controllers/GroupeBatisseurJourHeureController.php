<?php

namespace App\Http\Controllers;

use App\Models\GroupeBatisseurJour;
use App\Models\GroupeBatisseurJourHeure;
use App\Models\Heure;
use Illuminate\Http\Request;

class GroupeBatisseurJourHeureController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.procedure.';

    /**
     * afficher la liste des étapes d'un processus flow
     */
    public function index($id)
    {
        //sélectionner le workflow
        $groupe_batisseur_jour = GroupeBatisseurJour::findOrFail($id);
        return view($this->module_path . 'groupe_batisseur_jour_heures', compact('groupe_batisseur_jour'));
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create($id)
    {
        //sélectionner le workflow
        $groupe_batisseur_jour = GroupeBatisseurJour::findOrFail($id);
        $heures = Heure::all();
        return view($this->module_path . 'groupe_batisseur_jour_heure', compact('groupe_batisseur_jour', 'heures'));
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
                'heure_id' => ['required']
            ]);



            //contgroupe du doublon
            $groupe_batisseur_jour_heure = GroupeBatisseurJourHeure::where('heure_id', $request->heure_id)
                ->where('groupe_batisseur_jour_id', $request->groupe_batisseur_jour_id)->first();

            if ($groupe_batisseur_jour_heure == null) {

                //persistence dans la base
                $groupe_batisseur_jour_heure = new GroupeBatisseurJourHeure();
                $groupe_batisseur_jour_heure->groupe_batisseur_jour_id = $request->groupe_batisseur_jour_id;
                $groupe_batisseur_jour_heure->heure_id = $request->heure_id;

                $groupe_batisseur_jour_heure->save();
            }


            // //vérifier s'il s'agit du rôle admin
            // $groupe_admin = groupe::where('codeInterne', '0')->first();

            // if ($groupe_admin != null) {
            //     $current_user = $groupe_batisseur_jour->user;
            //     $current_user->is_admin = true;

            //     $current_user->save();
            // }
        } //cas de la suppression
        elseif (!empty($request->supp)) {
            $this->destroy($request->id);
        }
        //cas de la modification
        else {
            //validation des données lors de la sauvegarde
            $request->validate([
                'id' => ['required'],
                'heure_id' => ['required']
            ]);

            $this->update($request);
        }

        return redirect('/groupe_batisseur_jour_heures' . '/' . $request->groupe_batisseur_jour_id);
    }

    /**
     * afficher un enregistrement
     */
    public function show()
    {
        //
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $groupe_batisseur_jour_heure = GroupeBatisseurJourHeure::findOrFail($id);
        $heures = Heure::all();

        $groupe_batisseur_jour = $groupe_batisseur_jour_heure->groupe_batisseur_jour;

        return view($this->module_path . 'groupe_batisseur_jour_heure', compact('groupe_batisseur_jour_heure', 'heures', 'groupe_batisseur_jour'));
    }

    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $groupe_batisseur_jour_heure = GroupeBatisseurJourHeure::findOrFail($id);
        $heures = Heure::all();
        $groupe_batisseur_jour = $groupe_batisseur_jour_heure->groupe_batisseur;
        return view($this->module_path . 'groupe_batisseur_jour_heure', compact('groupe_batisseur_jour_heure', 'supp', 'groupe_batisseur_jour', 'heures'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $groupe_batisseur_jour_heure = GroupeBatisseurJourHeure::findOrfail($request->id);
        $groupe_batisseur_jour_heure->heure_id = $request->heure_id;
        $groupe_batisseur_jour_heure->save();

        return redirect('/groupe_batisseur_jour_heures' . '/' . $groupe_batisseur_jour_heure->groupe_batisseur_jour_id);
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        $groupe_batisseur_jour_heure = GroupeBatisseurJourHeure::findOrfail($id);
        GroupeBatisseurJourHeure::where('id', $id)->delete();

        return redirect('/groupe_batisseur_jour_heures' . '/' . $groupe_batisseur_jour_heure->groupe_batisseur_jour->id);
    }
}
