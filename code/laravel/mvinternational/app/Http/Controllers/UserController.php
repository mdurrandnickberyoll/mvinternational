<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.parametrage.';

    /**
     * afficher la liste des utilisateurs
     */
    public function index()
    {
        return view($this->module_path . 'users');
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create()
    {
        return view($this->module_path . 'user');
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
                // 'libelle' => ['required','min:3','unique:activites']
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed', 'min:8'],
                'telephone' => [
                    'required', 
                    'numeric', 
                    Rule::unique('users')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
            ]);

            //persistence dans la base
            $user = new User();
            $user->name = $request->name;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->telephone = $request->telephone;
            $user->adresse = $request->adresse;
            $user->password = $request->password;
            $user->is_admin = 1;

            $user->save();
        } //cas de la suppression
        elseif (!empty($request->supp)) {
            $this->destroy($request->id);
        }
        //cas de la modification
        else {
            //validation des données lors de la sauvegarde
            $request->validate([
                'id' => ['required'],
                // 'libelle' => ['required','min:3']
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed', 'min:8'],
                'telephone' => ['required', 'numeric', 'unique:users'],
            ]);

            $this->update($request);
        }

        return redirect('/users');
    }

    /**
     * afficher un enregistrement
     */
    public function show()
    {
        //
    }

    /**
     * Afficher la vue des rôles d'un user
     */

    public function show_role($id)
    {
        $user = User::findOrFail($id);
        return view($this->module_path . 'user_roles', compact('user'));
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $activite = User::findOrfail($id);
        return view($this->module_path . 'user', compact('user'));
    }

    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $activite = User::findOrfail($id);
        return view($this->module_path . 'user', compact('user', 'supp'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $user = User::findOrfail($request->id);

        $user->libelle = $request->libelle;
        $user->description = $request->description;

        //mise à jour des informations
        User::where('id', $user->id)->update([
            //    'libelle'=>$activite->libelle,
            //    'description'=>$activite->description

            'email' => $user->email,
            'password' => $user->password,
            'telephone' => $user->telephone,
        ]);

        return redirect('/users');
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
    }
}
