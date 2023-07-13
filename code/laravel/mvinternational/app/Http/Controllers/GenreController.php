<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GenreController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.referentiel.';

    /**
     * afficher la liste des activités
     */
    public function index()
    {
        return view($this->module_path . 'genres');
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create()
    {
        return view($this->module_path . 'genre');
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
                    Rule::unique('genres')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
            ]);

            //persistence dans la base
            $genre = new Genre();
            $genre->libelle = $request->libelle;

            $genre->save();
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

        return redirect('/genres');
    }

    /**
     * afficher un enregistrement
     */
    public function show(genre $genre)
    {
        //
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $genre = Genre::findOrfail($id);
        return view($this->module_path . 'genre', compact('genre'));
    }

    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $genre = Genre::findOrfail($id);
        return view($this->module_path . 'genre', compact('genre', 'supp'));
    }

    /**
     * mise à genre d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $genre = Genre::findOrfail($request->id);

        $genre->libelle = $request->libelle;

        //mise à genre des informations
        genre::where('id', $genre->id)->update([
            'libelle' => $genre->libelle,
        ]);

        return redirect('/genres');
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        Genre::where('id', $id)->delete();
    }
}
