<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
     //dossier contenant les vues du module
     public $module_path = 'mv_international_admin.parametrage.';
    
     /**
      * afficher la liste des documents
      */
     public function index()
     {
         return view($this->module_path.'documents');
     }
 
     /**
      * afficher le formulaire de creation 
      */
     public function create()
     {
          return view($this->module_path.'document');
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
                  'libelle' => [
                    'required',
                    'min:3',
                    Rule::unique('documents')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                  'codeInterne' => [
                    'required',
                    'min:3',
                    Rule::unique('documents')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ]
             ]);
 
             //persistence dans la base
             $document = new Document();
             $document->libelle =$request->libelle;
             $document->codeInterne =$request->codeInterne;
 
             $document->save();
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
                 'libelle' => ['required','min:3'],
                 'codeInterne' => ['required','min:3'],
             ]);
 
             $this->update($request);
         }
 
         return redirect('/documents');
 
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
         $document = Document::findOrfail($id);
         return view($this->module_path.'document',compact('document'));
     }
 
      /**
      * afficher le formulaire d'édition pour une suppression
      */
     public function edit_suppp($id,$supp)
     {
          $document = Document::findOrfail($id);
         return view($this->module_path.'document',compact('document','supp'));
     }
 
     /**
      * mise à jour d'une ligne dans la base 
      */
     public function update(Request $request)
     {
         $document = Document::findOrfail($request->id);
 
         $document->libelle =$request->libelle;
         $document->codeInterne =$request->codeInterne;
 
         //mise à jour des informations
          Document::where('id',$document->id)->update([
             'libelle'=>$document->libelle,
             'codeInterne'=>$document->codeInterne
         ]);
 
         return redirect('/documents');  
     }
 
     /**
      * Suppression d'une information dans la base
      */
     public function destroy($id)
     {
          Document::where('id',$id)->delete();
     }
}
