<?php

use App\Http\Response;
use App\Controllers\Pages\Home;



$router->get("/",[
    
    function(){
        return new Response(200,Home::index());
    }
]);

$router->get("/candidato/{id}/perfil",[
    "middlewares" => [
        "admin-access"
    ],
    function($id){
        return new Response(200,"Candidato - ".$id);
    }
]);
