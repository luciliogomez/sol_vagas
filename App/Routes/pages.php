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


// [GET]
$router->get("/logout",[
    "middlewares" => [
        "require-login"
    ],
    function($request){
        return new Response(200,Home::logout($request));
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

//[GET]
$router->get("/candidatos/{id}/dashboard",[
    "middlewares" => [
        "candidato-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::getDashboard($request,$id));
    }
]);


//[GET]
$router->get("/candidatos/{id}/perfil",[
    "middlewares" => [
    ],
    function($request,$id){
        return new Response(200,Candidato::getPerfil($request,$id));
    }
]);

$router->get("/candidatos/{id}/perfil/editar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::getEditPerfil($request,$id));
    }
]);


$router->post("/candidatos/{id}/perfil/editar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
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



$router->get("/candidatos/{id}/formacao/{id_formacao}/editar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id,$id_formacao){
        return new Response(200,Candidato::getEditarFormacao($request,$id,$id_formacao));
    }
]);

$router->post("/candidatos/{id}/formacao/{id_formacao}/editar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id,$id_formacao){
        return new Response(200,Candidato::setEditarFormacao($request,$id,$id_formacao));
    }
]);



$router->get("/candidatos/{id}/formacao/{id_formacao}/eliminar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id,$id_formacao){
        return new Response(200,Candidato::getEliminarFormacao($request,$id,$id_formacao));
    }
]);

// CURSOS PROFISSIONAIS
$router->get("/candidatos/{id}/cursos/adicionar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::getAdicionarCurso($request,$id));
    }
]);

$router->post("/candidatos/{id}/cursos/adicionar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::setAdicionarCurso($request,$id));
    }
]);



$router->get("/candidatos/{id}/curso/{id_curso}/editar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id,$id_curso){
        return new Response(200,Candidato::getEditarCurso($request,$id,$id_curso));
    }
]);

$router->post("/candidatos/{id}/curso/{id_curso}/editar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id,$id_curso){
        return new Response(200,Candidato::setEditarCurso($request,$id,$id_curso));
    }
]);



$router->get("/candidatos/{id}/curso/{id_curso}/eliminar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id,$id_curso){
        return new Response(200,Candidato::getEliminarCurso($request,$id,$id_curso));
    }
]);


//  EXPERIENCIAS

$router->get("/candidatos/{id}/experiencia/adicionar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::getAdicionarExperiencia($request,$id));
    }
]);

$router->post("/candidatos/{id}/experiencia/adicionar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id){
        return new Response(200,Candidato::setAdicionarExperiencia($request,$id));
    }
]);


$router->get("/candidatos/{id}/experiencia/{id_experiencia}/editar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id,$id_experiencia){
        return new Response(200,Candidato::getEditarExperiencia($request,$id,$id_experiencia));
    }
]);

$router->post("/candidatos/{id}/experiencia/{id_experiencia}/editar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id,$id_experiencia){
        return new Response(200,Candidato::setEditarExperiencia($request,$id,$id_experiencia));
    }
]);



$router->get("/candidatos/{id}/experiencia/{id_experiencia}/eliminar",[
    "middlewares" => [
        "admin-access",
        "candidato-access"
    ],
    function($request,$id,$id_experiencia){
        return new Response(200,Candidato::getEliminarExperiencia($request,$id,$id_experiencia));
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


