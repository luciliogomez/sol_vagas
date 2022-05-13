<?php
namespace App\Http\Middlewares;

class AdminAccess{

    public function handle($request,$next,$controllerArgs=null)
    {
        if(isset($_SESSION['id'])){
            echo "HIII";
            exit;
        }

        return $next($request);
    }
}