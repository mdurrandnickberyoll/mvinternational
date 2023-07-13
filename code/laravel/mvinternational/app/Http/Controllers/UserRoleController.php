<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.parametrage.';
    
    /**
     * afficher la liste des utilisateurs
     */
    public function index($id)
    {
        $user = User::findOrFail($id);
        return view($this->module_path.'user_roles',compact('user'));
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create($id)
    {
       $user = User::findOrFail($id);
       $roles = Role::all();

       return view($this->module_path.'user_role',compact('user','roles'));
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
                 'role_id' => ['required']
            ]);
 
            //controle du doublon
            $user_role = UserRole::where('role_id',$request->role_id)
            ->where('user_id',$request->user_id)->first();

            if($user_role == null) {

                //persistence dans la base
                $user_role = new UserRole();
                $user_role->user_id = $request->user_id;
                $user_role->role_id = $request->role_id;
    
                $user_role->save();
            }


            //vérifier s'il s'agit du rôle admin
            $role_admin = Role::where('codeInterne','0')->first();

            if($role_admin != null)
            {
               $current_user = $user_role->user;
               $current_user->is_admin = true;

               $current_user->save();
            }
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
                'role_id' => ['required']
            ]);

            $this->update($request);
        }

        return redirect('/user_roles'.'/'.$request->user_id);
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
       $user_role = UserRole::findOrFail($id);
       $roles = Role::all();

       $user = $user_role->user;

       return view($this->module_path.'user_role',compact('user_role','roles','user'));
    }

     /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id,$supp)
    {
       $user_role = UserRole::findOrFail($id);
       $roles = Role::all();
       $user = $user_role->user;
       return view($this->module_path.'user_role',compact('user_role','supp','user','roles'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
       $user_role = UserRole::findOrfail($request->id);
       $user_role->role_id =$request->role_id;
       $user_role->save();

       return redirect('/user_roles'.'/'.$user_role->user_id);
   }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
       $user_role = UserRole::findOrfail($id);
        UserRole::where('id',$id)->delete();

        return redirect('/user_roles'.'/'.$user_role->user->id);

    }
}
