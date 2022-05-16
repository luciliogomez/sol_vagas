<?php
namespace App\Controllers\Pages;

use App\Utils\Alert;
use App\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;
use App\Controllers\Pages\PagesBaseController;
use App\Models\Empresa as ModelsEmpresa;
use Exception;

class Empresa extends PagesBaseController{



    public static function getLogin($request)
    {
        return View::render("empresas::login",[
            "status" => self::getStatus($request),
            "email"  => '',
            "senha"  => ''
        ]);
    }


    public static function setLogin($request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['email']) || empty($postVars['senha']))
        {
            $request->getRouter()->redirect("/empresas/login?status=empty");
        }
        $email = $postVars['email'];
        $senha = $postVars['senha'];

        $model = new ModelsEmpresa();
        try{
            $empresa = $model->loadByEmail($email);
            if(!($empresa instanceof ModelsEmpresa)){
                return View::render("empresas::login",[
                    "status" => Alert::getError("Email Não Encontrado"),
                    "email"  => $email,
                    "senha"  => $senha
                ]);
            }
            if(password_verify($senha,$empresa->getSenha()) )
            {
                $_SESSION['usuario']["id"] = $empresa->getId();
                $_SESSION['usuario']["nome"] = $empresa->getNome();
                $_SESSION['usuario']["email"] = $empresa->getEmail();
                $_SESSION['usuario']["tipo"] = "empresas";
                $_SESSION['usuario']["logotipo"] = $empresa->getLogo();
  
                $request->getRouter()->redirect("/empresas/{$empresa->getId()}/dashboard");
            
            }else{

                return View::render("empresas::login",[
                    "status" => Alert::getError("Senha Errada"),
                    "email"  => $email,
                    "senha"  => $senha

                ]);    
            }


        }catch(Exception $ex)
        {echo "<pre>";
            print_r($ex->getMessage());
            echo "</pre>";
            exit;
                return View::render("empresas::login",[
                    "status" => Alert::getError("Ocorreu um erro. Tente novamente Mais tarde."),
                    "email"  => $postVars['email'],
                    "senha"  => $postVars['senha']

                ]);  
        }

    }


    public static function getDashboard($request,$id)
    {
        $model = new ModelsEmpresa();
        try{
            $empresa = $model->load($id);
            if(!($empresa instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("empresas::dashboard",[
                "empresa" => $empresa
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }

    public static function getPerfil($request,$id)
    {
        $model = new ModelsEmpresa();
        try{
            $empresa = $model->load($id);
            if(!($empresa instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("empresas::perfil",[
                "empresa" => $empresa
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA :".$ex->getMessage(),404);
        }
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
            case "updated":
                return Alert::getSucess("Dados Guardados!");
                break;
            case "error":
                return Alert::getError("Ocorreu um Erro. Tente novamente!");
                break;
            case "wrong_pass":
                return Alert::getError("Palavra-passe Errada!");
                break;
        }
    }

}


?>