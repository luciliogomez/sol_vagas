<?php
namespace App\Http\Middlewares;

class CandidatoAccess{

    public function handle($request,$next)
    {
        if( !isset($_SESSION["usuario"]) ||( isset($_SESSION["usuario"]) && ($_SESSION['usuario']["tipo"]!="candidato") ) ){
           
            $request->getRouter()->redirect("/candidatos/login");
        }
        
        return $next($request);
    }
}