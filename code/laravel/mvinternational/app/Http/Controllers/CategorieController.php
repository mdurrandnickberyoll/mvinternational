<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategorieController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.referentiel.';

    /**
     * afficher la liste des activités
     */
    public function index()
    {
        return view($this->module_path . 'categories');
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create()
    {
        return view($this->module_path . 'categorie');
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
                'libelle' => [
                    'required',
                    'min:3',
                    Rule::unique('categories')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                'icone' => ['required']
            ]);

            //persistence dans la base
            $categorie = new Categorie();
            $categorie->libelle = $request->libelle;
            $categorie->icone = $request->icone;

            $categorie->save();
        } //cas de la suppression
        elseif (!empty($request->supp)) {
            $this->destroy($request->id);
        }
        //cas de la modification
        else {
            //validation des données lors de la sauvegarde
            $request->validate([
                'id' => ['required'],
                'libelle' => ['required', 'min:3']
            ]);

            $this->update($request);
        }

        return redirect('/categories');
    }

    /**
     * afficher un enregistrement
     */
    public function show(categorie $categorie)
    {
        //
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $categorie = Categorie::findOrfail($id);
        return view($this->module_path . 'categorie', compact('categorie'));
    }

    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $categorie = Categorie::findOrfail($id);
        return view($this->module_path . 'categorie', compact('categorie', 'supp'));
    }

    /**
     * mise à categorie d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $categorie = Categorie::findOrfail($request->id);

        $categorie->libelle = $request->libelle;

        //mise à categorie des informations
        Categorie::where('id', $categorie->id)->update([
            'libelle' => $categorie->libelle,
            'icone' => $categorie->icone,
        ]);

        return redirect('/categories');
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        Categorie::where('id', $id)->delete();
    }
}
