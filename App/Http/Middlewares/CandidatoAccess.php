<?php
namespace App\Http\Middlewares;

class CandidatoAccess{

    public function handle($request,$next,$controllerArgs=null)
    {
        if( !isset($_SESSION["usuario"]) ||( isset($_SESSION["usuario"]) && ($_SESSION['usuario']["tipo"]!="candidatos") ) ){
           
            $request->getRouter()->redirect("/candidatos/login");
        }
        
        return $next($request);
    }
}