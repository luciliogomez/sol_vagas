<?php
require __DIR__."/vendor/autoload.php";
require __DIR__."/App/Utils/config.php";
use App\Controllers\Pages\Home;
use App\Http\Request;
use App\Http\Response;
use App\Http\Router;
use App\Utils\View;


$router = new Router(URL);

require __DIR__."/App/Routes/pages.php";


$router->run()->sendResponse();