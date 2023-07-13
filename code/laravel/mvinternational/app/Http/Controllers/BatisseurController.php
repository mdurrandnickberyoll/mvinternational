<?php

namespace App\Http\Controllers;

use App\Models\Batisseur;
use App\Models\Genre;
use App\Models\Groupe;
use App\Models\GroupeBatisseur;
use App\Models\GroupeBatisseurJour;
use App\Models\TrancheAge;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BatisseurController extends Controller
{
    //dossier contenant les vues du module
   public $module_path = 'mv_international_admin.procedure.';
    
   /**
    * afficher la liste des opérateurs
    */
   public function index()
   {
       return view($this->module_path.'batisseurs');
   }

   /**
    * afficher le formulaire de creation 
    */
   public function create()
   {
      $villes = Ville::all();
      $genres = Genre::all();
      $tranche_ages = TrancheAge::all();
     

      return view($this->module_path.'batisseur',compact('villes', 'genres', 'tranche_ages'));
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
                    Rule::unique('batisseurs')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                // 'password' => ['required', 'confirmed', 'min:8'],
             ]);

           //persistence dans la base
           $batisseur = new Batisseur();
           $batisseur->nom =$request->nom;
           $batisseur->prenom =$request->prenom;
           $batisseur->adresse =$request->adresse;
           $batisseur->email =$request->email;
           $batisseur->telephone =$request->telephone;
           $batisseur->eglise =$request->eglise;
          //   $batisseur->password = $request->password;
           
            
           $ville = Ville::findOrFail($request->ville_id);
           $genre = Genre::findOrFail($request->genre_id);
           $tranche_age = TrancheAge::findOrFail($request->tranche_age_id);

           $batisseur->tranche_age_id = $tranche_age->id;
           $batisseur->genre_id =$genre->id;
           $batisseur->ville_id =$ville->id;

           $batisseur->save();

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
            // 'password' => ['required', 'confirmed', 'min:8'],
            ]);

           $this->update($request);
       }

       return redirect('/batisseurs');

   }

   /**
    * afficher les détails du Batisseur
    */
   public function show($id)
    {
        $batisseur = Batisseur::findOrfail($id);
        $groupes = GroupeBatisseur::where('batisseur_id',$batisseur->id)->get();
        // $jours = GroupeBatisseurJour::all();


        // dd($groupe_batisseur);
        
        // $etape = Etape::where('statut_fin',$cluster->statut->id)->first();

        return view($this->module_path.'batisseur_show', compact('batisseur','groupes'));
    } 
 
   /**
    * afficher le formulaire d'édition.
    */
   public function edit($id)
   {
       $batisseur = Batisseur::findOrfail($id);
       $villes = Ville::all();
       $genres = Genre::all();
       $tranche_ages = TrancheAge::all();

       return view($this->module_path.'batisseur',compact('batisseur','villes', 'genres', 'tranche_ages'));
   }


   

    /**
    * afficher le formulaire d'édition pour une suppression
    */
   public function edit_suppp($id,$supp)
   {
        $batisseur = Batisseur::findOrfail($id);
       return view($this->module_path.'batisseur',compact('batisseur','supp'));
   }

   /**
    * mise à jour d'une ligne dans la base 
    */
   public function update(Request $request)
   {
        $batisseur = Batisseur::findOrfail($request->id);

        //champs à modifier
        $batisseur->nom =$request->nom;
        $batisseur->prenom =$request->prenom;
        $batisseur->adresse =$request->adresse;
        $batisseur->email =$request->email;
        $batisseur->telephone =$request->telephone;
             
        $ville = Ville::findOrFail($request->ville_id);
        $batisseur->ville_id =$ville->id;

        //modification
        $batisseur->save();

        //mise à jour des informations
        /*batisseur::where('id',$batisseur->id)->update([
        'libelle'=>$arrondissement->libelle,
        'ville_id'=>$arrondissement->ville_id
        ]);*/
    

        return redirect('/batisseurs');  
   }

   /**
    * Suppression d'une information dans la base
    */
   public function destroy($id)
   {
        Batisseur::where('id',$id)->delete();
   }
}
