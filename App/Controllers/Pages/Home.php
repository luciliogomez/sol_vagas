<?php
namespace App\Controllers\Pages;

use App\Models\Vaga;
use App\Utils\View;

class Home{

    public static function index()
    {
        $vagasModel = new Vaga();
        $vagas = $vagasModel->read(3);
        
        return View::render("home::home",[
            "vagas" => $vagas
        ]) ;
    }

    public static function logout($request)
    {
        unset($_SESSION['usuario']);
        session_unset();
        session_destroy();

        $request->getRouter()->redirect("/");

    }
}