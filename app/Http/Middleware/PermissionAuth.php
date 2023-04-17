<?php

namespace App\Http\Middleware;

use App\Models\Controleur;
use App\Models\Methode;
use App\Models\Permission;
use Closure;

class PermissionAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //auth
        if (auth()->guest()) {
            return redirect('/login');
        }

        //administrateur
        //if(auth()->user()->profil->libelle == "Admin"){
            return $next($request);
        //}
        
        //route
        $routeName = $request->route()->getName();
        $actionName = $request->route()->getActionName();
        $_action = explode('@',$actionName);
        $controllerName = (new \ReflectionClass($_action[0]))->getShortName();
        $methode = end($_action);

        //global action
        $global_action = [
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
        if(in_array($methode , $global_action)){
            return $next($request);
        }

        //$profil_id = auth()->user()->interim_profil_id != NULL ? auth()->user()->interim_profil_id : auth()->user()->profil_id;
        $controleur = Controleur::where('nom', $controllerName)->firstOrFail();
        
        $action = Methode::where([['controleur_id','=',$controleur->id],['nom','=', $routeName]])
                        ->orWhere([['controleur_id','=',$controleur->id],['methode','=', $methode]])
                        ->firstOrFail();
        //
        $action_id = $action->id;
        
        //similaire route
        if($methode == 'store'){
            $action_id = $controleur->methodes()->where('methode','=','create')->pluck('id')->first();
        }
        if($methode == 'update'){
            $action_id = $controleur->methodes()->where('methode','=','edit')->pluck('id')->first();
        }
        if($methode == 'show'){
            $action_id = $controleur->methodes()->where('methode','=','index')->pluck('id')->first();
        }
        if($methode == 'permission_store'){
            $action_id = $controleur->methodes()->where('methode','=','permission_create')->pluck('id')->first();
        }

        //$permission = Permission::where([['profil_id','=',$profil_id],['action_id','=',$action_id]])->first();
        $permission = Permission::where([['profil_id','=', auth()->user()->profil_id],['methode_id','=',$action_id]])
                                  ->orWhere([['profil_id','=', auth()->user()->interim_profil_id],['methode_id','=',$action_id]])
                                  ->first();

        if(is_null($permission)){
            return abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
