<?php

namespace App\Http\Controllers;

use App\Models\Heure;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HeureController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.referentiel.';
    
    /**
     * afficher la liste des activités
     */
    public function index()
    {
        return view($this->module_path.'heures');
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create()
    {
         return view($this->module_path.'heure');
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
                    Rule::unique('heures')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
            ]);

            //persistence dans la base
            $heure = new Heure();
            $heure->libelle =$request->libelle;
 
            $heure->save();
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

        return redirect('/heures');

    }

    /**
     * afficher un enregistrement
     */
    public function show(Heure $heure)
    {
        //
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $heure = Heure::findOrfail($id);
        return view($this->module_path.'heure',compact('heure'));
    }

     /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id,$supp)
    {
         $heure = Heure::findOrfail($id);
        return view($this->module_path.'heure',compact('heure','supp'));
    }

    /**
     * mise à heure d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $heure = Heure::findOrfail($request->id);

        $heure->libelle =$request->libelle;
 
        //mise à heure des informations
        Heure::where('id',$heure->id)->update([
            'libelle'=>$heure->libelle,
         ]);

        return redirect('/heures');  
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        Heure::where('id',$id)->delete();
    }
}
