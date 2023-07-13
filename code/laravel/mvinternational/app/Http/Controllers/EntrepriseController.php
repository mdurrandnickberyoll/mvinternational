<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;


class EntrepriseController extends Controller
{
    //dossier contenant les vues du module
    public $module_path = 'mv_international_admin.procedure.';

    /**
     * afficher la liste des activités
     */
    public function index()
    {
        return view($this->module_path . 'entreprises');
    }

    /**
     * afficher le formulaire de creation 
     */
    public function create()
    {
        return view($this->module_path . 'entreprise');
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
                    Rule::unique('entreprises')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                // 'file_id' => ['required', 'integer']

            ]);

            // // Récupérer le fichier téléchargé
            // $uploadedFile = $request->file('file');

            // // Ouvrir l'image avec Intervention\Image
            // $image = Image::make($uploadedFile);

            // // Réduire la taille de l'image (par exemple, à 800x600 pixels)
            // $image->resize(400, 300);

            // // Convertir l'image en contenu binaire
            // $fileContent = $image->encode();
            // $file = new File();
            // $file->binaire = $fileContent;
            // // dd($request->file('file')->getClientOriginalExtension());
            // $file->file_name =  $uploadedFile->getClientOriginalName();
            // $file->extension = '.' . $uploadedFile->getClientOriginalExtension();
            // $file->save();

            // $lastFileId = File::max('id');
            // dd($lastFileId);
            // dd($request->file('file'));
            // DB::beginTransaction();
            try {

                // Récupérer le fichier téléchargé
                $uploadedFile = $request->file('file');

                // Ouvrir l'image avec Intervention\Image
                $image = Image::make($uploadedFile);

                // Réduire la taille de l'image (par exemple, à 800x600 pixels)
                $image->resize(400, 300);

                // Convertir l'image en contenu binaire
                $fileContent = $image->encode();
                $file = new File();
                $file->binaire = $fileContent;
                // dd($request->file('file')->getClientOriginalExtension());
                $file->file_name =  $uploadedFile->getClientOriginalName();
                $file->extension = '.' . $uploadedFile->getClientOriginalExtension();
                
                $lastFileId = File::max('id');
                
                //persistence dans la base
                $entreprise = new Entreprise();
                $entreprise->nom = $request->nom;
                $entreprise->description = $request->description;
                $entreprise->file_id = $lastFileId;
                
                $file->save();
                $entreprise->save();


                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        } 
        //cas de la suppression
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

        return redirect('/entreprises');
    }

    /**
     * Affichage l'image sur la page
     */
    public function image_show($id)
    {
        $file = File::findOrFail($id);

        return view($this->module_path . 'entreprise_image_show', compact('file'));
    }


    /**
     * afficher un enregistrement
     */
    public function show($id)
    {
        $entreprise = entreprise::findOrfail($id);
        return view($this->module_path . 'entreprise_show', compact('entreprise'));
    }

    /**
     * afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $entreprise = entreprise::findOrfail($id);
        return view($this->module_path . 'entreprise', compact('entreprise'));
    }



    /**
     * afficher le formulaire d'édition pour une suppression
     */
    public function edit_suppp($id, $supp)
    {
        $entreprise = entreprise::findOrfail($id);
        return view($this->module_path . 'entreprise', compact('entreprise', 'supp'));
    }

    /**
     * mise à entreprise d'une ligne dans la base 
     */
    public function update(Request $request)
    {
        $entreprise = Entreprise::findOrfail($request->id);

        $entreprise->nom = $request->nom;
        $entreprise->description = $request->description;

        //mise à entreprise des informations
        Entreprise::where('id', $entreprise->id)->update([
            'nom' => $entreprise->nom,
            'description' => $entreprise->description,
        ]);

        return redirect('/entreprises');
    }

    /**
     * Suppression d'une information dans la base
     */
    public function destroy($id)
    {
        Entreprise::where('id', $id)->delete();
    }
}
