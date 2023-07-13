<?php

use App\Http\Controllers\BatisseurController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ComposantController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\GroupeBatisseurController;
use App\Http\Controllers\GroupeBatisseurJourController;
use App\Http\Controllers\GroupeBatisseurJourHeureController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\HeureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JourController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\paysController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\RoleComposantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatutController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\TrancheAgeController;
use App\Http\Controllers\TypeComposantController;
use App\Http\Controllers\TypeOrganisationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\WorkflowController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
#-----module Front
Route::get('/', function () {
    return view('front.pages.index');
});

// Route::get('/contact', function () {
//     return view('front.pages.contact');
// })->name('contact');

// Route::get('/apropos', function () {
//     return view('front.pages.about');
// })->name('about');

// Route::get('/job-list'   , function () {
//     return view('front.pages.job-list');
// })->name('job-list');
// Route::get('/job-detail'   , function () {
//     return view('front.pages.job-detail');
// })->name('job-detail');
// Route::get('/category'   , function () {
//     return view('front.pages.category');
// })->name('category');
// Route::get('/testimonial'   , function () {
//     return view('front.pages.index');
// })->name('testimonial');
// Route::get('/categorie'   , function () {
//     return view('front.pages.category');
// })->name('category');
// Route::get('/404'   , function () {
//     return view('front.pages.404');
// })->name('404');
// Route::get('/home'   , function () {
//     return view('front.pages.index');
// })->name('home');
Route::get('/home'   , function () {
    return view('front.pages.index');
})->name('home');

#-----module Admin

Route::get('/mv_international', function () {
    return view('mv_international_admin.login');
})->name('mv_international');

Route::middleware('auth')->group(function () {

    #dashboard

    Route::get('/mv_international_home', [HomeController::class, 'index'])->name('mv_international_home');

    #-----------------------------------------------------Groupe------------------------------------------------
    Route::get('/groupes', [groupeController::class, 'index'])->name('groupes');
    Route::get('/groupe', [groupeController::class, 'create'])->name('groupe');
    Route::post('/groupe_store', [groupeController::class, 'store'])->name('groupe_store');
    Route::get('/groupe_edit/{id}', [groupeController::class, 'edit'])->name('groupe_edit');
    Route::get('/groupe_del/{id}/{supp}', [GroupeController::class, 'edit_suppp'])->name('groupe_del');


    #-----------------------------------------------------Type Organisation------------------------------------------------
    Route::get('/type_organisations', [TypeOrganisationController::class, 'index'])->name('type_organisations');
    Route::get('/type_organisation', [TypeOrganisationController::class, 'create'])->name('type_organisation');
    Route::post('/type_organisation_store', [TypeOrganisationController::class, 'store'])->name('type_organisation_store');
    Route::get('/type_organisation_edit/{id}', [TypeOrganisationController::class, 'edit'])->name('type_organisation_edit');
    Route::get('/type_organisation_del/{id}/{supp}', [TypeOrganisationController::class, 'edit_suppp'])->name('type_organisation_del');


    #-----------------------------------------------------Organisation------------------------------------------------
    Route::get('/organisations', [OrganisationController::class, 'index'])->name('organisations');
    Route::get('/organisation', [OrganisationController::class, 'create'])->name('organisation');
    Route::post('/organisation_store', [OrganisationController::class, 'store'])->name('organisation_store');
    Route::get('/organisation_edit/{id}', [OrganisationController::class, 'edit'])->name('organisation_edit');
    Route::get('/organisation_del/{id}/{supp}', [OrganisationController::class, 'edit_suppp'])->name('organisation_del');

    #-----------------------------------------------------Composant------------------------------------------------
    Route::get('/composants', [ComposantController::class, 'index'])->name('composants');
    Route::get('/composant', [ComposantController::class, 'create'])->name('composant');
    Route::post('/composant_store', [ComposantController::class, 'store'])->name('composant_store');
    Route::get('/composant_edit/{id}', [ComposantController::class, 'edit'])->name('composant_edit');
    Route::get('/composant_del/{id}/{supp}', [ComposantController::class, 'edit_suppp'])->name('composant_del');

    #-----------------------------------------------------Type Composant------------------------------------------------
    Route::get('/type_composants', [TypeComposantController::class, 'index'])->name('type_composants');
    Route::get('/type_composant', [TypeComposantController::class, 'create'])->name('type_composant');
    Route::post('/type_composant_store', [TypeComposantController::class, 'store'])->name('type_composant_store');
    Route::get('/type_composant_edit/{id}', [TypeComposantController::class, 'edit'])->name('type_composant_edit');
    Route::get('/type_composant_del/{id}/{supp}', [TypeComposantController::class, 'edit_suppp'])->name('type_composant_del');
    #-----------------------------------------------------Role------------------------------------------------
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/role', [RoleController::class, 'create'])->name('role');
    Route::post('/role_store', [RoleController::class, 'store'])->name('role_store');
    Route::get('/role_edit/{id}', [RoleController::class, 'edit'])->name('role_edit');
    Route::get('/role_del/{id}/{supp}', [RoleController::class, 'edit_suppp'])->name('role_del');

    #-----------------------------------------------------RoleComposant------------------------------------------------
    Route::get('/role_composants/{id}', [RoleComposantController::class, 'index'])->name('role_composants');
    Route::get('/role_composant/{id}', [RoleComposantController::class, 'create'])->name('role_composant');
    Route::post('/role_composant_store', [RoleComposantController::class, 'store'])->name('role_composant_store');
    Route::get('/role_composant_edit/{id}', [RoleComposantController::class, 'edit'])->name('role_composant_edit');
    Route::get('/role_composant_del/{id}/{supp}', [RoleComposantController::class, 'edit_suppp'])->name('role_composant_del');

    #-----------------------------------------------------User------------------------------------------------
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user', [UserController::class, 'create'])->name('user');
    Route::post('/user_store', [UserController::class, 'store'])->name('user_store');
    Route::get('/user_edit/{id}', [UserController::class, 'edit'])->name('user_edit');
    Route::get('/user_del/{id}/{supp}', [UserController::class, 'edit_suppp'])->name('user_del');
    Route::get('/show_role/{id}', [UserController::class, 'show_role'])->name('show_role');

    #-----------------------------------------------------UserRole------------------------------------------------
    Route::get('/user_roles/{id}', [UserRoleController::class, 'index'])->name('user_roles');
    Route::get('/user_role/{id}', [UserRoleController::class, 'create'])->name('user_role');
    Route::post('/user_role_store', [UserRoleController::class, 'store'])->name('user_role_store');
    Route::get('/user_role_edit/{id}', [UserRoleController::class, 'edit'])->name('user_role_edit');
    Route::get('/user_role_del/{id}/{supp}', [UserRoleController::class, 'edit_suppp'])->name('user_role_del');

    #-----------------------------------------------------Pays------------------------------------------------
    Route::get('/payss', [PaysController::class, 'index'])->name('payss');
    Route::get('/pays', [PaysController::class, 'create'])->name('pays');
    Route::post('/pays_store', [PaysController::class, 'store'])->name('pays_store');
    Route::get('/pays_edit/{id}', [PaysController::class, 'edit'])->name('pays_edit');
    Route::get('/pays_del/{id}/{supp}', [PaysController::class, 'edit_suppp'])->name('pays_del');

    #-----------------------------------------------------Villes------------------------------------------------
    Route::get('/villes', [VilleController::class, 'index'])->name('villes');
    Route::get('/ville', [VilleController::class, 'create'])->name('ville');
    Route::post('/ville_store', [VilleController::class, 'store'])->name('ville_store');
    Route::get('/ville_edit/{id}', [VilleController::class, 'edit'])->name('ville_edit');
    Route::get('/ville_del/{id}/{supp}', [VilleController::class, 'edit_suppp'])->name('ville_del');

    #-----------------------------------------------------Jours------------------------------------------------
    Route::get('/jours', [JourController::class, 'index'])->name('jours');
    Route::get('/jour', [JourController::class, 'create'])->name('jour');
    Route::post('/jour_store', [JourController::class, 'store'])->name('jour_store');
    Route::get('/jour_edit/{id}', [JourController::class, 'edit'])->name('jour_edit');
    Route::get('/jour_del/{id}/{supp}', [JourController::class, 'edit_suppp'])->name('jour_del');

    #-----------------------------------------------------Jours------------------------------------------------
    Route::get('/heures', [HeureController::class, 'index'])->name('heures');
    Route::get('/heure', [HeureController::class, 'create'])->name('heure');
    Route::post('/heure_store', [HeureController::class, 'store'])->name('heure_store');
    Route::get('/heure_edit/{id}', [HeureController::class, 'edit'])->name('heure_edit');
    Route::get('/heure_del/{id}/{supp}', [HeureController::class, 'edit_suppp'])->name('heure_del');

    #-----------------------------------------------------Statuts------------------------------------------------
    Route::get('/statuts', [StatutController::class, 'index'])->name('statuts');
    Route::get('/statut', [StatutController::class, 'create'])->name('statut');
    Route::post('/statut_store', [StatutController::class, 'store'])->name('statut_store');
    Route::get('/statut_edit/{id}', [StatutController::class, 'edit'])->name('statut_edit');
    Route::get('/statut_del/{id}/{supp}', [StatutController::class, 'edit_suppp'])->name('statut_del');

    #-----------------------------------------------------Documents------------------------------------------------
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
    Route::get('/document', [DocumentController::class, 'create'])->name('document');
    Route::post('/document_store', [DocumentController::class, 'store'])->name('document_store');
    Route::get('/document_edit/{id}', [DocumentController::class, 'edit'])->name('document_edit');
    Route::get('/document_del/{id}/{supp}', [DocumentController::class, 'edit_suppp'])->name('document_del');

    #-----------------------------------------------------Workflows------------------------------------------------
    Route::get('/workflows', [WorkflowController::class, 'index'])->name('workflows');
    Route::get('/workflow', [WorkflowController::class, 'create'])->name('workflow');
    Route::post('/workflow_store', [WorkflowController::class, 'store'])->name('workflow_store');
    Route::get('/workflow_edit/{id}', [WorkflowController::class, 'edit'])->name('workflow_edit');
    Route::get('/workflow_del/{id}/{supp}', [WorkflowController::class, 'edit_suppp'])->name('workflow_del');

    #-----------------------------------------------------Etapes------------------------------------------------
    Route::get('/etapes/{id}', [EtapeController::class, 'index'])->name('etapes');
    Route::get('/etape/{id}', [EtapeController::class, 'create'])->name('etape');
    Route::post('/etape_store', [EtapeController::class, 'store'])->name('etape_store');
    Route::get('/etape_edit/{id}', [EtapeController::class, 'edit'])->name('etape_edit');
    Route::get('/etape_del/{id}/{supp}', [EtapeController::class, 'edit_suppp'])->name('etape_del');

    #-----------------------------------------------------Paramètres------------------------------------------------
    Route::get('/parametres', [ParametreController::class, 'index'])->name('parametres');
    Route::get('/parametre', [ParametreController::class, 'create'])->name('parametre');
    Route::post('/parametre_store', [ParametreController::class, 'store'])->name('parametre_store');
    Route::get('/parametre_edit/{id}', [ParametreController::class, 'edit'])->name('parametre_edit');
    Route::get('/parametre_del/{id}/{supp}', [ParametreController::class, 'edit_suppp'])->name('parametre_del');

    // #-----------------------------------------------------Paramètres------------------------------------------------
    // Route::get('/responsables', [ResponsableController::class, 'index'])->name('responsables');
    // Route::get('/responsable', [ResponsableController::class, 'create'])->name('responsable');
    // Route::post('/responsable_store', [ResponsableController::class, 'store'])->name('responsable_store');
    // Route::get('/responsable_edit/{id}', [ResponsableController::class, 'edit'])->name('responsable_edit');
    // Route::get('/responsable_del/{id}/{supp}', [ResponsableController::class, 'edit_suppp'])->name('responsable_del');
    // Route::get('/responsable_activate/{id}', [ResponsableController::class, 'activate'])->name('responsable_activate');

    #-----------------------------------------------------Genres------------------------------------------------
    Route::get('/genres', [GenreController::class, 'index'])->name('genres');
    Route::get('/genre', [GenreController::class, 'create'])->name('genre');
    Route::post('/genre_store', [GenreController::class, 'store'])->name('genre_store');
    Route::get('/genre_edit/{id}', [GenreController::class, 'edit'])->name('genre_edit');
    Route::get('/genre_del/{id}/{supp}', [GenreController::class, 'edit_suppp'])->name('genre_del');

    #-----------------------------------------------------TranchesAge------------------------------------------------
    Route::get('/tranche_ages', [TrancheAgeController::class, 'index'])->name('tranche_ages');
    Route::get('/tranche_age', [TrancheAgeController::class, 'create'])->name('tranche_age');
    Route::post('/tranche_age_store', [TrancheAgeController::class, 'store'])->name('tranche_age_store');
    Route::get('/tranche_age_edit/{id}', [TrancheAgeController::class, 'edit'])->name('tranche_age_edit');
    Route::get('/tranche_age_del/{id}/{supp}', [TrancheAgeController::class, 'edit_suppp'])->name('tranche_age_del');

    // #-----------------------------------------------------Batisseur------------------------------------------------
    // Route::get('/batisseurs', [BatisseurController::class, 'index'])->name('batisseurs');
    // Route::get('/batisseur', [BatisseurController::class, 'create'])->name('batisseur');
    // // Route::get('/batisseur_pdf', [BatisseurController::class, 'pdfGenerator'])->name('batisseur_pdf');
    // Route::get('/batisseur_show/{id}', [BatisseurController::class, 'show'])->name('batisseur_show');
    // Route::post('/batisseur_store', [BatisseurController::class, 'store'])->name('batisseur_store');
    // Route::get('/batisseur_edit/{id}', [BatisseurController::class, 'edit'])->name('batisseur_edit');
    // Route::get('/batisseur_del/{id}/{supp}', [BatisseurController::class, 'edit_suppp'])->name('batisseur_del');

    // #-----------------------------------------------------GroupBatisseurs------------------------------------------------

    // Route::get('/groupe_batisseurs/{id}', [GroupeBatisseurController::class, 'index'])->name('groupe_batisseurs');
    // Route::get('/groupe_batisseur/{id}', [GroupeBatisseurController::class, 'create'])->name('groupe_batisseur');
    // Route::post('/groupe_batisseur_store', [GroupeBatisseurController::class, 'store'])->name('groupe_batisseur_store');
    // Route::get('/groupe_batisseur_edit/{id}', [GroupeBatisseurController::class, 'edit'])->name('groupe_batisseur_edit');
    // Route::get('/groupe_batisseur_del/{id}/{supp}', [GroupeBatisseurController::class, 'edit_suppp'])->name('groupe_batisseur_del');

    // #-----------------------------------------------------GroupBatisseursJour------------------------------------------------

    // Route::get('/groupe_batisseur_jours/{id}', [GroupeBatisseurJourController::class, 'index'])->name('groupe_batisseur_jours');
    // Route::get('/groupe_batisseur_jour/{id}', [GroupeBatisseurJourController::class, 'create'])->name('groupe_batisseur_jour');
    // Route::post('/groupe_batisseur_jour_store', [GroupeBatisseurJourController::class, 'store'])->name('groupe_batisseur_jour_store');
    // Route::get('/groupe_batisseur_jour_edit/{id}', [GroupeBatisseurJourController::class, 'edit'])->name('groupe_batisseur_jour_edit');
    // Route::get('/groupe_batisseur_jour_del/{id}/{supp}', [GroupeBatisseurJourController::class, 'edit_suppp'])->name('groupe_batisseur_jour_del');

    // #-----------------------------------------------------GroupBatisseursJourHeur------------------------------------------------

    // Route::get('/groupe_batisseur_jour_heures/{id}', [GroupeBatisseurJourHeureController::class, 'index'])->name('groupe_batisseur_jour_heures');
    // Route::get('/groupe_batisseur_jour_heure/{id}', [GroupeBatisseurJourHeureController::class, 'create'])->name('groupe_batisseur_jour_heure');
    // Route::post('/groupe_batisseur_jour_heure_store', [GroupeBatisseurJourHeureController::class, 'store'])->name('groupe_batisseur_jour_heure_store');
    // Route::get('/groupe_batisseur_jour_heure_edit/{id}', [GroupeBatisseurJourHeureController::class, 'edit'])->name('groupe_batisseur_jour_heure_edit');
    // Route::get('/groupe_batisseur_jour_heure_del/{id}/{supp}', [GroupeBatisseurJourHeureController::class, 'edit_suppp'])->name('groupe_batisseur_jour_heure_del');

    #-----------------------------------------------------Catégories Page------------------------------------------------
    Route::get('/categories', [CategoriePageController::class, 'index'])->name('categories');
    Route::get('/categorie', [CategoriePageController::class, 'create'])->name('categorie');
    Route::post('/categorie_store', [CategoriePageController::class, 'store'])->name('categorie_store');
    Route::get('/categorie_edit/{id}', [CategoriePageController::class, 'edit'])->name('categorie_edit');
    Route::get('/categorie_del/{id}/{supp}', [CategoriePageController::class, 'edit_suppp'])->name('categorie_del');

    #-----------------------------------------------------Témoignage------------------------------------------------
    Route::get('/temoignages', [TemoignageController::class, 'index'])->name('temoignages');
    Route::get('/temoignage', [TemoignageController::class, 'create'])->name('temoignage');
    Route::post('/temoignage_store', [TemoignageController::class, 'store'])->name('temoignage_store');
    Route::get('/temoignage_edit/{id}', [TemoignageController::class, 'edit'])->name('temoignage_edit');
    Route::get('/temoignage_del/{id}/{supp}', [TemoignageController::class, 'edit_suppp'])->name('temoignage_del');

    // #-----------------------------------------------------Catégories------------------------------------------------
    // Route::get('/entreprises', [EntrepriseController::class, 'index'])->name('entreprises');
    // Route::get('/entreprise', [EntrepriseController::class, 'create'])->name('entreprise');
    // Route::post('/entreprise_store', [EntrepriseController::class, 'store'])->name('entreprise_store');
    // Route::get('/entreprise_edit/{id}', [EntrepriseController::class, 'edit'])->name('entreprise_edit');
    // Route::get('/entreprise_show/{id}', [EntrepriseController::class, 'show'])->name('entreprise_show');
    // Route::get('/entreprise_image_show/{id}', [EntrepriseController::class, 'image_show'])->name('entreprise_image_show');
    // Route::get('/entreprise_del/{id}/{supp}', [EntrepriseController::class, 'edit_suppp'])->name('entreprise_del');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
