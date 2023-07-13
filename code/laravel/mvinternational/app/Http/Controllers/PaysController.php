<?php

namespace App\Http\Controllers;

use App\Models\pays;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class paysController extends Controller
{
     //dossier contenant les vues du module
     public $module_path = 'mv_international_admin.localite.';
    
     /**
      * afficher la liste des activités
      */
     public function index()
     {
         return view($this->module_path.'payss');
     }
 
     /**
      * afficher le formulaire de creation 
      */
     public function create()
     {
          return view($this->module_path.'pays');
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
                    Rule::unique('pays')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
             ]);
 
             //persistence dans la base
             $pays = new Pays();
             $pays->libelle =$request->libelle;
  
             $pays->save();
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
 
         return redirect('/payss');
 
     }
 
     /**
      * afficher un enregistrement
      */
     public function show(Pays $pays)
     {
         //
     }
 
     /**
      * afficher le formulaire d'édition.
      */
     public function edit($id)
     {
         $pays = pays::findOrfail($id);
         return view($this->module_path.'pays',compact('pays'));
     }
 
      /**
      * afficher le formulaire d'édition pour une suppression
      */
     public function edit_suppp($id,$supp)
     {
          $pays = pays::findOrfail($id);
         return view($this->module_path.'pays',compact('pays','supp'));
     }
 
     /**
      * mise à jour d'une ligne dans la base 
      */
     public function update(Request $request)
     {
         $pays = Pays::findOrfail($request->id);
 
         $pays->libelle =$request->libelle;
  
         //mise à jour des informations
          Pays::where('id',$pays->id)->update([
             'libelle'=>$pays->libelle,
          ]);
 
         return redirect('/payss');  
     }
 
     /**
      * Suppression d'une information dans la base
      */
     public function destroy($id)
     {
          Pays::where('id',$id)->delete();
     }
}
