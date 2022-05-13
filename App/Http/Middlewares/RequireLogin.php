<?php
namespace App\Http\Middlewares;

class RequireLogin{

    public function handle($request,$next,$controllerArgs=null)
    {
        if( !isset($_SESSION["usuario"])){
            $request->getRouter()->redirect("/");
        }
        
        return $next($request);
    }
}