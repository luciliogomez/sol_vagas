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

// [GET]
$router->get("/candidatos/login",[
    "middlewares" => [
        "require-logout"
    ],
    function($request){
        return new Response(200,Candidato::getLogin($request));
    }
]);

// [POST]
$router->post("/candidatos/login",[
    "middlewares" => [
        "require-logout"
    ],
    function($request){
        return new Response(200,Candidato::setLogin($request));
    }
]);

$router->get("/candidatos/{id}/dashboard",[
    "middlewares" => [
        "candidato-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::getDashboard($request,$id));
    }
]);


$router->get("/candidatos/{id}/perfil",[
    "middlewares" => [
    ],
    function($request,$id){
        return new Response(200,Candidato::getPerfil($request,$id));
    }
]);

$router->get("/candidatos/{id}/perfil/editar",[
    "middlewares" => [
        "admin-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::getEditPerfil($request,$id));
    }
]);


$router->post("/candidatos/{id}/perfil/editar",[
    "middlewares" => [
        "admin-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::setEditPerfil($request,$id));
    }
]);


$router->get("/candidatos/{id}/formacao/adicionar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::getAdicionarFormacao($request,$id));
    }
]);

$router->post("/candidatos/{id}/formacao/adicionar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::setAdicionarFormacao($request,$id));
    }
]);


// EMPRESAS ROUTES
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


