<?php

namespace App\Http\Controllers;

use App\Models\Batisseur;
use App\Models\Groupe;
use App\Models\GroupeBatisseur;
use Illuminate\Http\Request;

class GroupeBatisseurController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.procedure.';

    /**
     * afficher la liste des étapes d'un processus flow
     */
    public function index($id)
    {
        //sélectionner le workflow
        $batisseur = Batisseur::findOrFail($id);
        return view($this->module_path . 'groupe_batisseurs', compact('batisseur'));
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create($id)
    {
        //sélectionner le workflow
        $batisseur = Batisseur::findOrFail($id);
        $groupes = Groupe::all();
        return view($this->module_path . 'groupe_batisseur', compact('batisseur', 'groupes'));
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
                'groupe_id' => ['required']
            ]);



            //contgroupe du doublon
            $groupe_batisseur = GroupeBatisseur::where('groupe_id', $request->groupe_id)
                ->where('batisseur_id', $request->batisseur_id)->first();

            if ($groupe_batisseur == null) {

                //persistence dans la base
                $groupe_batisseur = new GroupeBatisseur();
                $groupe_batisseur->batisseur_id = $request->batisseur_id;
                $groupe_batisseur->groupe_id = $request->groupe_id;

                $groupe_batisseur->save();
            }


            // //vérifier s'il s'agit du rôle admin
            // $groupe_admin = groupe::where('codeInterne', '0')->first();

            // if ($groupe_admin != null) {
            //     $current_user = $groupe_batisseur->user;
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
                'groupe_id' => ['required']
            ]);

            $this->update($request);
        }

        return redirect('/groupe_batisseurs' . '/' . $request->batisseur_id);
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
       $groupe_batisseur = GroupeBatisseur::findOrFail($id);
       $groupes = Groupe::all();

       $batisseur = $groupe_batisseur->batisseur;


       return view($this->module_path.'groupe_batisseur',compact('groupe_batisseur','groupes','batisseur'));
    }

     /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id,$supp)
    {
       $groupe_batisseur = GroupeBatisseur::findOrFail($id);
       $groupes = Groupe::all();
       $batisseur = $groupe_batisseur->batisseur;
       return view($this->module_path.'groupe_batisseur',compact('groupe_batisseur','supp','batisseur','groupes'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
       $groupe_batisseur = GroupeBatisseur::findOrfail($request->id);
       $groupe_batisseur->groupe_id =$request->groupe_id;
       $groupe_batisseur->save();

       return redirect('/groupe_batisseurs'.'/'.$groupe_batisseur->batisseur_id);
   }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
       $groupe_batisseur = GroupeBatisseur::findOrfail($id);
        GroupeBatisseur::where('id',$id)->delete();

        return redirect('/groupe_batisseurs'.'/'.$groupe_batisseur->batisseur->id);

    }
}
