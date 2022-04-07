<?php

use App\Controllers\Pages\Candidato;
use App\Http\Response;
use App\Controllers\Pages\Home;
use App\Controllers\Pages\Vaga;

$router->get("/",[
    function(){
        return new Response(200,Home::index());
    }
]);


$router->get("/vagas",[
    function($request){
        return new Response(200,Vaga::index($request));
    }
]);



$router->get("/vagas/{id}/ver",[
    function($request,$id){
        return new Response(200,Vaga::getVaga($request,$id));
    }
]);


$router->get("/vagas/{id}/aplicar",[
    "middlewares"=>[
        "candidato-access"
    ],
    function(){
        return new Response(200,Home::index());
    }
]);

$router->get("/candidatos/login",[
    "middlewares" => [
        "require-logout"
    ],
    function($request){
        return new Response(200,Candidato::getLogin($request));
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


$router->get("/vagas/publicar",[
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


