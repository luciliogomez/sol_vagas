<?php
namespace App\Http\Middlewares;

class EmpresaAccess{

    public function handle($request,$next,$controllerArgs=null)
    {
        if( !isset($_SESSION["usuario"]) ||( isset($_SESSION["usuario"]) && ($_SESSION['usuario']["tipo"]!="empresas") ) ){
           
            $request->getRouter()->redirect("/empresas/login");
        }
        
        return $next($request);
    }
}