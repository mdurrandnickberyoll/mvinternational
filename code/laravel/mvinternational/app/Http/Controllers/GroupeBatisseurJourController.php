<?php

namespace App\Http\Controllers;

use App\Models\GroupeBatisseur;
use App\Models\GroupeBatisseurJour;
use App\Models\Jour;
use Illuminate\Http\Request;

class GroupeBatisseurJourController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.procedure.';

    /**
     * afficher la liste des étapes d'un processus flow
     */
    public function index($id)
    {
        //sélectionner le workflow
        $groupe_batisseur = GroupeBatisseur::findOrFail($id);
        return view($this->module_path . 'groupe_batisseur_jours', compact('groupe_batisseur'));
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create($id)
    {
        //sélectionner le workflow
        $groupe_batisseur = GroupeBatisseur::findOrFail($id);
        $jours = Jour::all();
        return view($this->module_path . 'groupe_batisseur_jour', compact('groupe_batisseur', 'jours'));
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
                'jour_id' => ['required']
            ]);



            //contgroupe du doublon
            $groupe_batisseur_jour = GroupeBatisseurJour::where('jour_id', $request->jour_id)
                ->where('groupe_batisseur_id', $request->groupe_batisseur_id)->first();

            if ($groupe_batisseur_jour == null) {

                //persistence dans la base
                $groupe_batisseur_jour = new GroupeBatisseurJour();
                $groupe_batisseur_jour->groupe_batisseur_id = $request->groupe_batisseur_id;
                $groupe_batisseur_jour->jour_id = $request->jour_id;

                $groupe_batisseur_jour->save();
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
                'jour_id' => ['required']
            ]);

            $this->update($request);
        }

        return redirect('/groupe_batisseur_jours' . '/' . $request->groupe_batisseur_id);
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
        $groupe_batisseur_jour = GroupeBatisseurJour::findOrFail($id);
        $jours = Jour::all();

        $groupe_batisseur = $groupe_batisseur_jour->groupe_batisseur;

        return view($this->module_path . 'groupe_batisseur_jour', compact('groupe_batisseur_jour', 'jours', 'groupe_batisseur'));
    }

    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $groupe_batisseur_jour = GroupeBatisseurJour::findOrFail($id);
        $jours = Jour::all();
        $groupe_batisseur = $groupe_batisseur_jour->groupe_batisseur;
        return view($this->module_path . 'groupe_batisseur_jour', compact('groupe_batisseur_jour', 'supp', 'groupe_batisseur', 'jours'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $groupe_batisseur_jour = GroupeBatisseurJour::findOrfail($request->id);
        $groupe_batisseur_jour->jour_id = $request->jour_id;
        $groupe_batisseur_jour->save();

        return redirect('/groupe_batisseur_jours' . '/' . $groupe_batisseur_jour->groupe_batisseur_id);
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        $groupe_batisseur_jour = GroupeBatisseurJour::findOrfail($id);
        GroupeBatisseurJour::where('id', $id)->delete();

        return redirect('/groupe_batisseur_jours' . '/' . $groupe_batisseur_jour->groupe_batisseur->id);
    }
}
