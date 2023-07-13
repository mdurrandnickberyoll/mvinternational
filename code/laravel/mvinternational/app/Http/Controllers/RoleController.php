<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.parametrage.';

    /**
     * afficher la liste des activités
     */
    public function index()
    {
        return view($this->module_path . 'roles');
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create()
    {
        return view($this->module_path . 'role');
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
                    Rule::unique('roles')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
            ]);

            //persistence dans la base
            $role = new Role();
            $role->libelle = $request->libelle;
            $role->codeInterne = $request->codeInterne;

            $role->save();
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

        return redirect('/roles');
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
        $role = Role::findOrfail($id);
        return view($this->module_path . 'role', compact('role'));
    }

    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $role = Role::findOrfail($id);
        return view($this->module_path . 'role', compact('role', 'supp'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $role = Role::findOrfail($request->id);

        $role->libelle = $request->libelle;
        $role->codeInterne = $request->codeInterne;
        
        $role->save();

        return redirect('/roles');
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        Role::where('id', $id)->delete();
    }
}
