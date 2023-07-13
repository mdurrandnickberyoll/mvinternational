<?php

namespace App\Http\Controllers;

use App\Models\TypeComposant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypeComposantController extends Controller
{
   //dossier contenant les vues du module
   public $module_path = 'mv_international_admin.parametrage.';
    
   /**
    * afficher la liste des activités
    */
   public function index()
   {
       return view($this->module_path.'type_composants');
   }

   /**
    * afficher le formulaire de creation 
    */
   public function create()
   {
        return view($this->module_path.'type_composant');
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
                    Rule::unique('type_composants')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
           ]);

           //persistence dans la base
           $type_composant = new TypeComposant();
           $type_composant->libelle =$request->libelle;
 
           $type_composant->save();
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

       return redirect('/type_composants');

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
       $type_composant = TypeComposant::findOrfail($id);
       return view($this->module_path.'type_composant',compact('type_composant'));
   }

    /**
    * afficher le formulaire d'édition pour une suppression
    */
   public function edit_suppp($id,$supp)
   {
        $type_composant = TypeComposant::findOrfail($id);
       return view($this->module_path.'type_composant',compact('type_composant','supp'));
   }

   /**
    * mise à jour d'une ligne dans la base 
    */
   public function update(Request $request)
   {
       $type_composant = TypeComposant::findOrfail($request->id);

       $type_composant->libelle =$request->libelle;
 
       //mise à jour des informations
        TypeComposant::where('id',$type_composant->id)->update([
           'libelle'=>$type_composant->libelle,
        ]);

       return redirect('/type_composants');  
   }

   /**
    * Suppression d'une information dans la base
    */
   public function destroy($id)
   {
        TypeComposant::where('id',$id)->delete();
   }
}
