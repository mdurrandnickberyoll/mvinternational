<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Workflow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WorkflowController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.parametrage.';
    
    /**
     * afficher la liste des flux de travail
     */
    public function index()
    {
        return view($this->module_path.'workflows');
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create()
    {
       $documents = Document::all();
       return view($this->module_path.'workflow',compact('documents'));
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
                    Rule::unique('workflows')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                 'document_id' => ['required']
            ]);

            //persistence dans la base
            $workflow = new Workflow();
            $workflow->libelle =$request->libelle;
            
            $document = Document::findOrFail($request->document_id);
            $workflow->document_id =$document->id;

            $workflow->save();

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
                'document_id' => ['required']
            ]);

            $this->update($request);
        }

        return redirect('/workflows');

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
        $workflow = Workflow::findOrfail($id);
        $documents = Document::all();

        return view($this->module_path.'workflow',compact('workflow','documents'));
    }

     /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id,$supp)
    {
         $workflow = Workflow::findOrfail($id);
        return view($this->module_path.'workflow',compact('workflow','supp'));
    }

    /**
     * mise à jour d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $workflow = Workflow::findOrfail($request->id);
        $workflow->libelle =$request->libelle;

        $document = Document::findOrFail($request->document_id);
        $workflow->document_id =$document->id;

        $workflow->save(); 
        return redirect('/workflows');  
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
         Document::where('id',$id)->delete();
    }
}
