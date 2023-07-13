<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\TypeOrganisation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganisationController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.parametrage.';

    /**
     * afficher la liste des crédits
     */
    public function index()
    {
        return view($this->module_path . 'organisations');
    }

    /**
     * afficher le formulaire de création 
     */
    public function create()
    {
        $type_organisations = TypeOrganisation::all();
        return view($this->module_path . 'organisation', compact('type_organisations'));
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
                'libelle' => ['
                required', 
                'min:3', 
                Rule::unique('organisations')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
                'type_organisation_id' => ['required', 'integer']
            ]);

            //persistence dans la base
            $organisation = new Organisation();
            $organisation->libelle = $request->libelle;
            $organisation->type_organisation_id = $request->type_organisation_id;

            $organisation->save();
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

        return redirect('/organisations');
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $organisation = Organisation::findOrfail($id);
        $type_organisations = TypeOrganisation::all();
        return view($this->module_path . 'organisation', compact('organisation', 'type_organisations'));
    }

    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $organisation = Organisation::findOrfail($id);
        return view($this->module_path . 'organisation', compact('organisation', 'supp'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $organisation = Organisation::findOrfail($request->id);

        $organisation->libelle = $request->libelle;
        $organisation->type_organisation_id = $request->type_organisation_id;
        //mise à jour des informations
        $organisation->save();

        return redirect('/organisations');
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        Organisation::find($id)->delete();
    }
}
