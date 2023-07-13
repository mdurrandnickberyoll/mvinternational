<?php

namespace App\Http\Controllers;

use App\Models\Jour;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JourController extends Controller
{
     //dossier contenant les vues du module
     public $module_path = 'mv_international_admin.referentiel.';
    
     /**
      * afficher la liste des activités
      */
     public function index()
     {
         return view($this->module_path.'jours');
     }
 
     /**
      * afficher le formulaire de creation 
      */
     public function create()
     {
          return view($this->module_path.'jour');
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
                    Rule::unique('jours')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
             ]);
 
             //persistence dans la base
             $jour = new Jour();
             $jour->libelle =$request->libelle;
  
             $jour->save();
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
 
         return redirect('/jours');
 
     }
 
     /**
      * afficher un enregistrement
      */
     public function show(Jour $jour)
     {
         //
     }
 
     /**
      * afficher le formulaire d'édition.
      */
     public function edit($id)
     {
         $jour = Jour::findOrfail($id);
         return view($this->module_path.'jour',compact('jour'));
     }
 
      /**
      * afficher le formulaire d'édition pour une suppression
      */
     public function edit_suppp($id,$supp)
     {
          $jour = Jour::findOrfail($id);
         return view($this->module_path.'jour',compact('jour','supp'));
     }
 
     /**
      * mise à jour d'une ligne dans la base 
      */
     public function update(Request $request)
     {
         $jour = Jour::findOrfail($request->id);
 
         $jour->libelle =$request->libelle;
  
         //mise à jour des informations
         Jour::where('id',$jour->id)->update([
             'libelle'=>$jour->libelle,
          ]);
 
         return redirect('/jours');  
     }
 
     /**
      * Suppression d'une information dans la base
      */
     public function destroy($id)
     {
        Jour::where('id',$id)->delete();
     }
}
