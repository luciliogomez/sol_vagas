<?php

use App\Http\Middlewares\AdminAccess;
use App\Utils\View;
use App\Http\Middlewares\Queue as MiddlewareQueue;

// BASE URL
define("URL","http://localhost/jobfinder");

define("ASSETS",URL."/resources/assets");

//DATABASE CONFIGURATIONS
define("HOST","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DBNAME","job");


// SETING  VIEW CONFIGURATIONS
$view = new View("App/Views");
$view::setFolders([
    "home"     => "App/Views/pages",
    "template" => "App/Views/layout/template",
    "pagination" =>"App/Views/layout/pagination", 
    "error" => "App/Views/layout",
    "admin"    => "App/Views/admin",
    "candidatos"    => "App/Views/pages/candidatos",
    "empresas"    => "App/Views/pages/empresas",
    "vagas"    => "App/Views/pages/vagas",
    "login"    => "App/Views/pages/login"
]);


// SETING MIDDLEWARES MAPS

MiddlewareQueue::setMap([
    "admin-access" => App\Http\Middlewares\AdminAccess::class
]);


