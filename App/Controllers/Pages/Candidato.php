<?php
namespace App\Controllers\Pages;

use App\Utils\Alert;
use App\Utils\View;

class Candidato extends PagesBaseController{


    public static function getLogin($request)
    {
        return View::render("candidatos::login",[
            "status" => self::getStatus($request)
        ]);
    }

    public static function setLogin($request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['email']) || empty($postVars['senha']))
        {
            $request->getRouter()->redirect("/candidatos/login?status=empty");
        }
        echo "<pre>";
print_r($request->getPostVars());
echo "</pre>";
exit;
    }

    public static function getStatus($request)
    {
        $queryParams = $request->getQueryParams();
        if(!isset($queryParams['status'])){
            return "";
        }
        switch($queryParams['status'])
        {
            case "empty":
                return Alert::getError("Preencha os campos obrigatorios!");
                break;
        }
    }

}