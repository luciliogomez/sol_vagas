<?php

use App\Http\Middlewares\AdminAccess;
use App\Utils\View;
use App\Http\Middlewares\Queue as MiddlewareQueue;
use WilliamCosta\DotEnv\Environment;

Environment::load(__DIR__."/../../");
// BASE URL
define("URL",getenv("URL"));

define('BASE_DIR',getenv("BASE_DIR") );

define("ASSETS",URL."/resources/assets");

define("UPLOADS",BASE_DIR."/uploads");

//DATABASE CONFIGURATIONS
define("HOST",getenv("HOST"));
define("USERNAME",getenv("USERNAME"));
define("PASSWORD",getenv("PASSWORD"));
define("DBNAME",getenv("DBNAME"));


// SETING  VIEW CONFIGURATIONS
$view = new View("App/Views");
$view::setFolders([
    "home"     => "App/Views/pages",
    "template" => "App/Views/layout/template",
    "pagination" =>"App/Views/layout/pagination", 
    "layout" =>"App/Views/layout", 
    "error" => "App/Views/layout",
    "admin"    => "App/Views/admin",
    "candidatos"    => "App/Views/pages/candidatos",
    "empresas"    => "App/Views/pages/empresas",
    "vagas"    => "App/Views/pages/vagas",
    "login"    => "App/Views/pages/login"
]);


// SETING MIDDLEWARES MAPS

MiddlewareQueue::setMap([
    "admin-access" => App\Http\Middlewares\AdminAccess::class,
    "candidato-access" => App\Http\Middlewares\CandidatoAccess::class,
    "require-logout" => App\Http\Middlewares\RequireLogout::class,
    "require-login" => App\Http\Middlewares\RequireLogin::class,
    "candidato-private-access" => App\Http\Middlewares\CandidatoPrivateAccess::class,
    "empresa-require-login" => App\Http\Middlewares\EmpresaRequireLogin::class,
    "empresa-access" => App\Http\Middlewares\EmpresaAccess::class,
    "empresa-private-access" => App\Http\Middlewares\EmpresaPrivateAccess::class
]);


