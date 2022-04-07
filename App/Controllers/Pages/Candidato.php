<?php
namespace App\Controllers\Pages;

use App\Utils\View;

class Candidato extends PagesBaseController{


    public static function getLogin($request)
    {

        return View::render("candidatos::login");
    }

}