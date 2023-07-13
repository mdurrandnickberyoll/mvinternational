<?php

namespace App\Providers;

use App\Models\GroupeBatisseurJour;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GroupeBatisseurJourServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
        $this->app->bind('jours', function ($app, $parameters) {
            dd($app);
            $groupe_batisseur_id = $parameters['groupe_batisseur_id'];
            // $groupe_batisseur_id = $parameters['groupe_batisseur_id']; // Récupérer l'ID du groupe depuis les paramètres
            $jours = GroupeBatisseurJour::where('groupe_batisseur_id', $groupe_batisseur_id)->get(); // Récupérer les jours correspondant à l'ID du groupe

            return $jours;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Blade::directive('jours', function ($expression) {
        //     dd($expression);
        //     $groupe_batisseur_id = $expression;
        //     // $groupe_batisseur_id = $parameters['groupe_batisseur_id']; // Récupérer l'ID du groupe depuis les paramètres
        //     $jours = GroupeBatisseurJour::where('groupe_batisseur_id', $groupe_batisseur_id)->get(); // Récupérer les jours correspondant à l'ID du groupe

        //     return $jours;
        // });
    }
}
