<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\Heure;
use App\Models\Jour;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupeController extends Controller
{
   //dossier contenant les vues du module
   public $module_path = 'mv_international_admin.referentiel.';
    
   /**
    * afficher la liste des groupes
    */
   public function index()
   {
       return view($this->module_path.'groupes');
   }

   /**
    * afficher le formulaire de creation 
    */
   public function create()
   {
        $heures = Heure::all();
        $jours = Jour::all();
        return view($this->module_path.'groupe', compact('heures', 'jours'));
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
                    Rule::unique('groupes')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
           ]);

           //persistence dans la base
           $groupe = new Groupe();
           $groupe->libelle =$request->libelle;
           $groupe->description =$request->description;
           $groupe->jour =$request->jour;
           $groupe->hrure =$request->hrure;

           $groupe->save();
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
               'libelle' => ['required','min:3']
           ]);

           $this->update($request);
       }

       return redirect('/groupes');

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
       $groupe = Groupe::findOrfail($id);
       return view($this->module_path.'groupe',compact('groupe'));
   }

    /**
    * afficher le formulaire d'édition pour une suppression
    */
   public function edit_suppp($id,$supp)
   {
        $groupe = Groupe::findOrfail($id);
       return view($this->module_path.'groupe',compact('groupe','supp'));
   }

   /**
    * mise à jour d'une ligne dans la base 
    */
   public function update(Request $request)
   {
       $groupe = Groupe::findOrfail($request->id);

       $groupe->libelle =$request->libelle;
       $groupe->description =$request->description;

       //mise à jour des informations
       Groupe::where('id',$groupe->id)->update([
           'libelle'=>$groupe->libelle,
           'description'=>$groupe->description
       ]);

       return redirect('/groupes');  
   }

   /**
    * Suppression d'une information dans la base
    */
   public function destroy($id)
   {
        Groupe::where('id',$id)->delete();
   }
}
