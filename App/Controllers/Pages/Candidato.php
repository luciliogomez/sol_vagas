<?php
namespace App\Controllers\Pages;

use App\Models\Candidato as ModelsCandidato;
use App\Utils\Alert;
use App\Utils\View;
use Exception;

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

        $model = new ModelsCandidato();
        try{
            $candidato = $model->loadByEmail($postVars['email']);
            if(!($candidato instanceof ModelsCandidato)){
                return View::render("candidatos::login",[
                    "status" => Alert::getError("Email Não Encontrado")
                ]);
            }

            if(password_verify($postVars['senha'],$candidato->getSenha()) )
            {
                
                $_SESSION['usuario']["id"] = $candidato->getId();
                $_SESSION['usuario']["nome"] = $candidato->getNome();
                $_SESSION['usuario']["email"] = $candidato->getEmail();
                $_SESSION['usuario']["tipo"] = "candidato";
                $_SESSION['usuario']["foto"] = $candidato->getFoto();
  
                $request->getRouter()->redirect("/candidatos/{$candidato->getId()}/dashboard");
            
            }else{
                $request->getRouter()->redirect("/candidatos/login?status=wrong_pass");    
            }


        }catch(Exception $ex)
        {
            $request->getRouter()->redirect("/candidatos/login?status=error");
        }

    }


    public static function getDashboard($request,$id)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("candidatos::dashboard");

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
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
            case "error":
                return Alert::getError("Ocorreu um Erro. Tente novamente!");
                break;
            case "wrong_pass":
                return Alert::getError("Palavra-passe Errada!");
                break;
        }
    }

}