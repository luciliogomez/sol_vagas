<?php
namespace App\Http\Middlewares;

class CandidatoPrivateAccess{

    public function handle($request,$next,$controllerArgs=null)
    {
        $idTarget = $controllerArgs['id']; 
     
        if( ( isset($_SESSION["usuario"]) && ($_SESSION['usuario']["id"]!=$idTarget) ) ){
           
            $request->getRouter()->redirect("/candidatos/{$_SESSION['usuario']['id']}/perfil");
        }
        
        return $next($request);
    }
}