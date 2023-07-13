<?php

namespace App\Http\Controllers;

use App\Models\Composant;
use App\Models\TypeComposant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComposantController extends Controller
{
        //dossier contenant les vues du module
        public $module_path = 'mv_international_admin.parametrage.';

        /**
         * afficher la liste des composants
         */
        public function index()
        {
            return view($this->module_path . 'composants');
        }
    
        /**
         * afficher le formulaire de création 
         */
        public function create()
        {
            $type_composants = TypeComposant::all();
            return view($this->module_path . 'composant', compact('type_composants'));
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
                        Rule::unique('composants')->where(function ($query) {
                            $query->whereNull('deleted_at');
                        }),
                    ],
                    'type_composant_id' => ['required', 'integer'],
                    'codeInterne' => ['required']
                ]);
    
                //persistence dans la base
                $composant = new Composant();
                $composant->libelle = $request->libelle;
                $composant->type_composant_id = $request->type_composant_id;
                $composant->codeInterne = $request->codeInterne;
    
                $composant->save();
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
    
            return redirect('/composants');
        }
    
        /**
         * afficher le formulaire d'édition.
         */
        public function edit($id)
        {
            $composant = Composant::findOrfail($id);
            $type_composants = TypeComposant::all();
            return view($this->module_path . 'composant', compact('composant', 'type_composants'));
        }
    
        /**
         * afficher le formulaire d'édition pour une suppression
         */
        public function edit_suppp($id, $supp)
        {
            $composant = Composant::findOrfail($id);
            return view($this->module_path . 'composant', compact('composant', 'supp'));
        }
    
        /**
         * mise à jour d'une ligne dans la base 
         */
        public function update(Request $request)
        {
            $composant = Composant::findOrfail($request->id);
    
            $composant->libelle = $request->libelle;
            $composant->type_composant_id = $request->type_composant_id;
            $composant->codeInterne = $request->codeInterne;
            //mise à jour des informations
            $composant->save();
    
            return redirect('/composants');
        }
    
        /**
         * Suppression d'une information dans la base
         */
        public function destroy($id)
        {
            Composant::find($id)->delete();
        }
}
