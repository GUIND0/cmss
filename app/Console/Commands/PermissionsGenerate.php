<?php

namespace App\Console\Commands;

use App\Models\Methode;
use App\Models\Controleur;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class PermissionsGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:generate {--fresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates permissions based on your routes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $options = $this->options();
        if ($options['fresh']){
            Controleur::query()->forceDelete();
            Methode::query()->forceDelete();
        }
        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $route){
            // get route action
            $actionName = $route->getActionName();
            if($actionName == "Closure"){
                continue;
            }
            // separating controller and method
            $_action = explode('@',$actionName);
            $controller = (new \ReflectionClass($_action[0]))->getShortName();
            $action = end($_action);

            $routeName = $route->getName();
            
           

            $controleur = Controleur::firstOrCreate([
                'nom' => $controller,
                'description' => 'Module '.explode('Controller',$controller)[0]
            ]);

            $globalAction = [
                'login',
                'connexion',
                'deconnexion',
                'oublie',
                'compte',
                'password',
                'info',
                'accueil',
                'getArticles',
                'imprimer',
                'joindre',
                'commentaire'
            ];

            $_formateur = [
                'index'=> 'Lister',
                'create'=> 'Créer',
                'edit'=> 'Modifier',
                'destroy'=> 'Supprimer',
                'reset'=> 'Réinitialiser mot de passe',
                'permission_create'=> 'Gérer des permissions',
                'journal'=> 'Voir les logs utilisateurs',
                'acquitter' => 'Acquitter',
                'soumettre' => 'Soumettre',
                'valider' => 'Valider',
                'rejeter' => 'Rejeter' ,
                'list_besoin' => 'Voir tous les besoins' ,
                'list_conge' => 'Voir tous les congés' ,
                'list_projet' => 'Voir tous les projets' ,
                'list_mission' => 'Voir toutes les missions' ,
                'mes_taches' => 'Voir mes taches' ,
                'gerer'=> 'Voir tout le personnel',
                'executer'=> 'Executer',
                'facture'=> 'Voir les factures',
                'generer'=> 'Generer des factures',
                'dashboard'=> 'Voir le tableau de bord',
                'elaborer'=> 'Elaborer le budget',

            ];
            //ignore global Action
            if(!in_array($action, $globalAction)) {
                $action = Methode::firstOrCreate([
                    'controleur_id' => $controleur->id,
                    'nom' => $routeName,
                    'methode' => $action,
                    'description' => isset($_formateur[$action]) ? $_formateur[$action] : null,
                ]);
            }
              
        }
        
    }
}