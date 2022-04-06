<?php

use App\Http\Response;
use App\Controllers\Pages\Home;



$router->get("/",[
    function(){
        return new Response(200,Home::index());
    }
]);


$router->get("/vagas",[
    function(){
        return new Response(200,Home::index());
    }
]);

$router->get("/vagas/publicar",[
    function(){
        return new Response(200,Home::index());
    }
]);


$router->get("/vagas/{id}/ver",[
    function(){
        return new Response(200,Home::index());
    }
]);


$router->get("/vagas/{id}/aplicar",[
    function(){
        return new Response(200,Home::index());
    }
]);

$router->get("/empresas/{id}/perfil",[
    function(){
        return new Response(200,Home::index());
    }
]);

$router->get("/empresas/{id}/editar",[
    function(){
        return new Response(200,Home::index());
    }
]);


$router->get("/candidatos/{id}/perfil",[
    "middlewares" => [
        "admin-access"
    ],
    function($id){
        return new Response(200,"Candidato - ".$id);
    }
]);

$router->get("/candidatos/{id}/editar",[
    "middlewares" => [
        "admin-access"
    ],
    function($id){
        return new Response(200,"Candidato - ".$id);
    }
]);


$router->get("/candidaturas",[
    "middlewares" => [
        "admin-access"
    ],
    function($id){
        return new Response(200,"Candidato - ".$id);
    }
]);


$router->get("/candidaturas/{id}/ver",[
    "middlewares" => [
        "admin-access"
    ],
    function($id){
        return new Response(200,"Candidato - ".$id);
    }
]);


