<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VilleController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.localite.';
    
    /**
     * afficher la liste des activités
     */
    public function index()
    {
        return view($this->module_path.'villes');
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create()
    {
       $pays = Pays::all();
       return view($this->module_path.'ville',compact('pays'));
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
                    Rule::unique('villes')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
            ]);

            //persistence dans la base
            $ville = new ville();
            $ville->libelle =$request->libelle;
            
            $pays = Pays::findOrFail($request->pays_id);
            $ville->pays_id =$pays->id;

            $ville->save();

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

        return redirect('/villes');

    }

    /**
     * afficher un enregistrement
     */
    public function show(ville $activite)
    {
        //
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $ville = ville::findOrfail($id);
        $villes = Ville::all();

        return view($this->module_path.'ville',compact('ville','villes'));
    }

     /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id,$supp)
    {
         $ville = ville::findOrfail($id);
        return view($this->module_path.'ville',compact('ville','supp'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $ville = ville::findOrfail($request->id);

        $ville->libelle =$request->libelle;

        $ville = Ville::findOrFail($request->ville_id);
        $ville->ville_id =$ville->id;
 
        //mise à jour des informations
         ville::where('id',$ville->id)->update([
            'libelle'=>$ville->libelle,
            'ville_id'=>$ville->ville_id
         ]);

        return redirect('/villes');  
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
         ville::where('id',$id)->delete();
    }
}
