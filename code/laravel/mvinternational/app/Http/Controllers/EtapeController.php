<?php

namespace App\Http\Controllers;

use App\Models\Etape;
use App\Models\Role;
use App\Models\Statut;
use App\Models\Workflow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EtapeController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.parametrage.';
    
    /**
     * afficher la liste des étapes d'un processus flow
     */
    public function index($id)
    {
        //sélectionner le workflow
        $workflow = Workflow::findOrFail($id);
        return view($this->module_path.'etapes',compact('workflow'));
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create($id)
    {
       $statuts = Statut::all();
       $roles = Role::all();

       //sélectionner le workflow
       $workflow = Workflow::findOrFail($id);

       return view($this->module_path.'etape',compact('statuts','roles','workflow'));
    }

    /**
     * enregistrer une information dans la base de données
     */
    public function store(Request $request)
    {
        //cas de la création 
        if(empty($request->id))
        { 
            //validation des données lors de la sauvegarde
            $request->validate([
                 'libelle' => [
                    'required',
                    'min:3',
                    Rule::unique('etapes')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                 'sequence' => [
                    'required',
                    Rule::unique('etapes')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                 'statut_debut' => ['required'],
                 'statut_fin' => ['required'],
                 'workflow_id' => ['required']
            ]);

            //affectation des valeurs dans l'objet
            $etape = new Etape();
            $etape->libelle =$request->libelle;
            
            $statut_debut = Statut::findOrFail($request->statut_debut);
            $statut_fin = Statut::findOrFail($request->statut_fin);

            $workflow_id = Workflow::findOrFail($request->workflow_id);
            $role = Role::findOrFail($request->role);

 
            $etape->statut_debut = $statut_debut->id;
            $etape->statut_fin = $statut_fin->id;
            

            $etape->workflow_id = $workflow_id->id;
            $etape->role_id = $role->id;
            $etape->sequence = $request->sequence;
 
            //persistence dans la base
            $etape->save();

        }//cas de la suppression
        elseif(!empty($request->supp))
        {
            $this->destroy($request->id);
        }
        //cas de la modification
        else{ 
            //validation des données lors de la sauvegarde
            $request->validate([
                'id' => ['required'],
                'libelle' => ['required','min:3'],
                'sequence' => ['required'],
                'statut_debut' => ['required'],
                'statut_fin' => ['required'],
                'workflow_id' => ['required']
            ]); 
            $this->update($request);
        }

        
        return redirect('/etapes'.'/'.$request->workflow_id);

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
        $etape = Etape::findOrfail($id);
        $roles = Role::all();
        $statuts = Statut::all();

         //sélectionner le workflow
       $workflow = Workflow::findOrFail($etape->workflow->id);

        return view($this->module_path.'etape',compact('statuts','roles','etape','workflow'));
    }

     /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id,$supp)
    {
         $etape = Etape::findOrfail($id);
        return view($this->module_path.'etape',compact('etape','supp'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $etape = Etape::findOrfail($request->id);
        $etape->libelle =$request->libelle;

         //persistence dans la base
         $etape = new Etape();
         $etape->libelle =$request->libelle;
         
         $statut_debut = Statut::findOrFail($request->statut_debut);
         $statut_fin = Statut::findOrFail($request->statut_fin);

         $workflow_id = Workflow::findOrFail($request->workflow_id);

         $etape->statut_debut = $statut_debut->id;
         $etape->statut_fin = $statut_fin->id;
         $etape->workflow_id = $workflow_id->id;
 
        //mise à jour des informations
         Etape::where('id',$etape->id)->update([
            'libelle'=> $request->libelle,
            'statut_debut'=> $etape->statut_debut,
            'statut_fin'=> $etape->statut_fin,
            'workflow_id'=> $etape->workflow_id
         ]);

        return redirect('/etapes');  
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
         Etape::where('id',$id)->delete();
    }
}
