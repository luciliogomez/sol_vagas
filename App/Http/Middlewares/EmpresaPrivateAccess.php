<?php
namespace App\Http\Middlewares;

class EmpresaPrivateAccess{

    public function handle($request,$next,$controllerArgs=null)
    {
        $idTarget = $controllerArgs['id']; 
     
        if( ( isset($_SESSION["usuario"]) && ($_SESSION['usuario']["id"]!=$idTarget) ) ){
           
            $request->getRouter()->redirect("/empresas/{$_SESSION['usuario']['id']}/perfil");
        }
        
        return $next($request);
    }
}