<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TemoignageController extends Controller
{
     //dossier contenant les vues du module
     public $module_path = 'mv_international_admin.referentiel.';

     /**
      * afficher la liste des activités
      */
     public function index()
     {
         return view($this->module_path . 'temoignages');
     }
 
     /**
      * afficher le formulaire de creation 
      */
     public function create()
     {
         return view($this->module_path . 'temoignage');
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
                 'nom' => [
                     'required',
                     'min:3',
                     Rule::unique('temoignages')->where(function ($query) {
                         $query->whereNull('deleted_at');
                     }),
                 ],
                 'profession' => ['required']
             ]);
 
             //persistence dans la base
             $temoignage = new Temoignage();
             $temoignage->nom = $request->nom;
             $temoignage->profession = $request->profession;
             $temoignage->content = $request->content;
 
             $temoignage->save();
         } //cas de la suppression
         elseif (!empty($request->supp)) {
             $this->destroy($request->id);
         }
         //cas de la modification
         else {
             //validation des données lors de la sauvegarde
             $request->validate([
                 'id' => ['required'],
                 'nom' => ['required', 'min:3']
             ]);
 
             $this->update($request);
         }
 
         return redirect('/temoignages');
     }
 
     /**
      * afficher un enregistrement
      */
     public function show(temoignage $temoignage)
     {
         //
     }
 
     /**
      * afficher le formulaire d'édition.
      */
     public function edit($id)
     {
         $temoignage = temoignage::findOrfail($id);
         return view($this->module_path . 'temoignage', compact('temoignage'));
     }
 
     /**
      * afficher le formulaire d'édition pour une suppression
      */
     public function edit_suppp($id, $supp)
     {
         $temoignage = Temoignage::findOrfail($id);
         return view($this->module_path . 'temoignage', compact('temoignage', 'supp'));
     }
 
     /**
      * mise à temoignage d'une ligne dans la base 
      */
     public function update(Request $request)
     {
         $temoignage = Temoignage::findOrfail($request->id);
 
         $temoignage->nom = $request->nom;
 
         //mise à temoignage des informations
         temoignage::where('id', $temoignage->id)->update([
             'nom' => $temoignage->libelle,
             'profession' => $temoignage->profession,
         ]);
 
         return redirect('/temoignages');
     }
 
     /**
      * Suppression d'une information dans la base
      */
     public function destroy($id)
     {
         Temoignage::where('id', $id)->delete();
     }
}
