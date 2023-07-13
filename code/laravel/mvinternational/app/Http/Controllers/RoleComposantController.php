<?php

namespace App\Http\Controllers;

use App\Models\Composant;
use App\Models\Role;
use App\Models\RoleComposant;
use Illuminate\Http\Request;

class RoleComposantController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.parametrage.';
    
    /**
     * afficher la liste des composants d'un rôle 
     */
    public function index($id)
    {
        $role = Role::findOrFail($id);
        return view($this->module_path.'role_composants',compact('role'));
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create($id)
    {
       $role = Role::findOrFail($id);
       $composants = Composant::all();

       return view($this->module_path.'role_composant',compact('role','composants'));
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
                 'composant_id' => ['required']
            ]);
  
            //persistence dans la base
            $role_composant = new RoleComposant();
            $role_composant->composant_id = $request->composant_id;
            $role_composant->role_id = $request->role_id;

            $role_composant->save(); 
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
                'composant_id' => ['required'],
                'role_id' => ['required']
            ]);

            $this->update($request);
        }

        return redirect('/role_composants'.'/'.$request->role_id);
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
       $role_composant = RoleComposant::findOrFail($id);
       $composants = Composant::all();

       $role = $role_composant->role;

       return view($this->module_path.'role_composant',compact('role_composant','composants','role'));
    }

     /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id,$supp)
    {
       $role_composant = RoleComposant::findOrFail($id);
       $composants = Composant::all();
       $role = $role_composant->role;

       return view($this->module_path.'role_composant',compact('role_composant','supp','role','composants'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
       $role_composant = RoleComposant::findOrfail($request->id);
       $role_composant->composant_id =$request->composant_id;
       $role_composant->save();

       return redirect('/role_composants'.'/'.$role_composant->role_id);
   }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
       $role_composant = RoleComposant::findOrfail($id);
       RoleComposant::where('id',$id)->delete();

        return redirect('/role_composants'.'/'.$role_composant->role_id);

    }
}
