<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParametreController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.parametrage.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view($this->module_path . 'parametres');
    }

    /**
     * afficher le formulaire de création 
     */
    public function create()
    {
        return view($this->module_path . 'parametre');
    }

    /**
     * enregistrer une information dans la base de données
     */
    public function store(Request $request)
    {
        //cas de la création 
        if (empty($request->id)) {
            //validation des données lors de la sauvegarde
            $request->validate([
                'code' => [
                    'required', 
                    'min:2', 
                    Rule::unique('parametres')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                'valeur' => ['required']
            ]);

            //persistence dans la base
            $parametre = new Parametre();
            $parametre->code = $request->code;
            $parametre->valeur = $request->valeur;
            $parametre->description = $request->description;

            $parametre->save();
        } //cas de la suppression
        elseif (!empty($request->supp)) {
            $this->destroy($request->id);
        }
        //cas de la modification
        else {
            //validation des données lors de la sauvegarde
            $request->validate([
                'id' => ['required'],
                'code' => ['required']
            ]);

            $this->update($request);
        }

        return redirect('/parametres');
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $parametre = Parametre::findOrfail($id);
        return view($this->module_path . 'parametre', compact('parametre'));
    }

    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $parametre = Parametre::findOrfail($id);
        return view($this->module_path . 'parametre', compact('parametre', 'supp'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $parametre = Parametre::findOrfail($request->id);

        $parametre->code = $request->code;
        $parametre->valeur = $request->valeur;
        $parametre->description = $request->description;
        //mise à jour des informations
        $parametre->save();

        return redirect('/parametres');
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        Parametre::find($id)->delete();
    }
}
