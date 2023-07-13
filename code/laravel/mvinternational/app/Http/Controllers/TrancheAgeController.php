<?php

namespace App\Http\Controllers;

use App\Models\TrancheAge;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TrancheAgeController extends Controller
{
         //dossier contenant les vues du module
         public $module_path = 'mv_international_admin.referentiel.';
    
         /**
          * afficher la liste des activités
          */
         public function index()
         {
             return view($this->module_path.'tranche_ages');
         }
     
         /**
          * afficher le formulaire de creation 
          */
         public function create()
         {
              return view($this->module_path.'tranche_age');
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
                        Rule::unique('tranche_ages')->where(function ($query) {
                            $query->whereNull('deleted_at');
                        }),
                    ]
                 ]);
     
                 //persistence dans la base
                 $tranche_age = new TrancheAge();
                 $tranche_age->libelle =$request->libelle;
      
                 $tranche_age->save();
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
     
             return redirect('/tranche_ages');
     
         }
     
         /**
          * afficher un enregistrement
          */
         public function show(TrancheAge $tranche_age)
         {
             //
         }
     
         /**
          * afficher le formulaire d'édition.
          */
         public function edit($id)
         {
             $tranche_age = TrancheAge::findOrfail($id);
             return view($this->module_path.'tranche_age',compact('tranche_age'));
         }
     
          /**
          * afficher le formulaire d'édition pour une suppression
          */
         public function edit_suppp($id,$supp)
         {
              $tranche_age = TrancheAge::findOrfail($id);
             return view($this->module_path.'tranche_age',compact('tranche_age','supp'));
         }
     
         /**
          * mise à tranche_age d'une ligne dans la base 
          */
         public function update(Request $request)
         {
             $tranche_age = TrancheAge::findOrfail($request->id);
     
             $tranche_age->libelle =$request->libelle;
      
             //mise à tranche_age des informations
             TrancheAge::where('id',$tranche_age->id)->update([
                 'libelle'=>$tranche_age->libelle,
              ]);
     
             return redirect('/tranche_ages');  
         }
     
         /**
          * Suppression d'une information dans la base
          */
         public function destroy($id)
         {
            TrancheAge::where('id',$id)->delete();
         }
}
