<?php

namespace App\Http\Controllers;

use App\Models\TypeOrganisation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypeOrganisationController extends Controller
{
    //dossier contenant les vues du module
   public $module_path = 'mv_international_admin.parametrage.';
    
   /**
    * afficher la liste des organisations
    */
   public function index()
   {
       return view($this->module_path.'type_organisations');
   }

   /**
    * afficher le formulaire de creation 
    */
   public function create()
   {
        return view($this->module_path.'type_organisation');
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
                    Rule::unique('type_organisations')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
           ]);

           //persistence dans la base
           $type_organisation = new TypeOrganisation();
           $type_organisation->libelle =$request->libelle;

           $type_organisation->save();
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

       return redirect('/type_organisations');

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
       $type_organisation = TypeOrganisation::findOrfail($id);
       return view($this->module_path.'type_organisation',compact('type_organisation'));
   }

    /**
    * afficher le formulaire d'édition pour une suppression
    */
   public function edit_suppp($id,$supp)
   {
        $type_organisation = TypeOrganisation::findOrfail($id);
       return view($this->module_path.'type_organisation',compact('type_organisation','supp'));
   }

   /**
    * mise à jour d'une ligne dans la base 
    */
   public function update(Request $request)
   {
       $type_organisation = TypeOrganisation::findOrfail($request->id);

       $type_organisation->libelle =$request->libelle;

       //mise à jour des informations
       TypeOrganisation::where('id',$type_organisation->id)->update([
           'libelle'=>$type_organisation->libelle,
       ]);

       return redirect('/type_organisations');  
   }

   /**
    * Suppression d'une information dans la base
    */
   public function destroy($id)
   {
        TypeOrganisation::where('id',$id)->delete();
   }
}
