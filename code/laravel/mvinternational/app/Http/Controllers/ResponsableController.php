<?php

namespace App\Http\Controllers;

use App\Models\Responsable;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResponsableController extends Controller
{
   //dossier contenant les vues du module
   public $module_path = 'mv_international_admin.procedure.';
    
   /**
    * afficher la liste des opérateurs
    */
   public function index()
   {
       return view($this->module_path.'responsables');
   }

   /**
    * afficher le formulaire de creation 
    */
   public function create()
   {
      $villes = Ville::all();
      return view($this->module_path.'responsable',compact('villes'));
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
                'nom' => ['required','min:3'],
                'prenom' => ['required','min:3'],
                'adresse' => ['required','min:3'],
                'telephone' => [
                    'required',
                    'min:3',
                    Rule::unique('responsables')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                'password' => ['required', 'confirmed', 'min:8'],
             ]);

           //persistence dans la base
           $responsable = new Responsable();
           $responsable->nom =$request->nom;
           $responsable->prenom =$request->prenom;
           $responsable->adresse =$request->adresse;
           $responsable->email =$request->email;
           $responsable->telephone =$request->telephone;
           $responsable->password = $request->password;
           $responsable->statut = 0;
            
           $ville = Ville::findOrFail($request->ville_id);
           $responsable->ville_id =$ville->id;

           $responsable->save();

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
            'nom' => ['required','min:3'],
            'prenom' => ['required','min:3'],
            'adresse' => ['required','min:3'],
            'telephone' => ['required','min:3'],
            'password' => ['required', 'confirmed', 'min:8'],
            ]);

           $this->update($request);
       }

       return redirect('/responsables');

   }
 
   /**
    * afficher le formulaire d'édition.
    */
   public function edit($id)
   {
       $responsable = Responsable::findOrfail($id);
       $villes = Ville::all();

       return view($this->module_path.'responsable',compact('responsable','villes'));
   }

   /**
    * Valider la demande d'inscription d'un opérteur
    */

   public function activate($id)
   {
       $responsable = Responsable::findOrfail($id);
       $responsable->statut = 1;

       $responsable->save();
 
       return redirect('responsables');
   }

   

    /**
    * afficher le formulaire d'édition pour une suppression
    */
   public function edit_suppp($id,$supp)
   {
        $responsable = Responsable::findOrfail($id);
       return view($this->module_path.'responsable',compact('responsable','supp'));
   }

   /**
    * mise à jour d'une ligne dans la base 
    */
   public function update(Request $request)
   {
        $responsable = Responsable::findOrfail($request->id);

        //champs à modifier
        $responsable->nom =$request->nom;
        $responsable->prenom =$request->prenom;
        $responsable->adresse =$request->adresse;
        $responsable->email =$request->email;
        $responsable->telephone =$request->telephone;
             
        $ville = Ville::findOrFail($request->ville_id);
        $responsable->ville_id =$ville->id;

        //modification
        $responsable->save();

        //mise à jour des informations
        /*responsable::where('id',$responsable->id)->update([
        'libelle'=>$arrondissement->libelle,
        'ville_id'=>$arrondissement->ville_id
        ]);*/
    

        return redirect('/responsables');  
   }

   /**
    * Suppression d'une information dans la base
    */
   public function destroy($id)
   {
        Responsable::where('id',$id)->delete();
   }
}
