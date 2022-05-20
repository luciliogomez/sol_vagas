<?php
namespace App\Http\Middlewares;

class EmpresaRequireLogin{

    public function handle($request,$next,$controllerArgs=null)
    {
        if( !isset($_SESSION["usuario"])){
            $request->getRouter()->redirect("/empresas/login");
        }
        
        return $next($request);
    }
}