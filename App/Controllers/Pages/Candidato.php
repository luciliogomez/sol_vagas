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
                $_SESSION['usuario']["tipo"] = "candidatos";
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
    
    public static function getPerfil($request,$id)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("candidatos::perfil",[
                "candidato" => $candidato
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }

    public static function getEditPerfil($request,$id)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("candidatos::editar",[
                "nome" => $candidato->getNome(),
                'email' =>$candidato->getEmail(),
                'titulo'=>$candidato->getTitulo(),
                'resumo'=>$candidato->getResumo(),
                'telefone'=>$candidato->getTelefone(),
                'estado'=>$candidato->getEstado(),
                'ingles'=>$candidato->getNivelIngles(),
                'cidade'=>$candidato->getCidade(),
                'foto'=>'',
                'status' => self::getStatus($request)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }
    public static function setEditPerfil($request,$id)
    {
        $postVars = $request->getPostVars();

        if( empty($postVars['nome']) || empty($postVars['email']) 
            || empty($postVars['titulo'])|| empty($postVars['cidade'])  
        ){
            return View::render("candidatos::editar",[
                "nome" => $postVars['nome'],
                'email' =>$postVars['email'],
                'titulo'=>$postVars['titulo'],
                'resumo'=>$postVars['resumo'],
                'telefone'=>$postVars['telefone'],
                'estado'=>$postVars['estado'],
                'ingles'=>$postVars['ingles'],
                'cidade'=>$postVars['cidade'],
                'foto'=>'',
                'status' => Alert::getError("Preencha os campos obrigatórios")
            ]);
        }

        $nome = filter_var($postVars['nome'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email =  filter_var($postVars['email'],FILTER_SANITIZE_EMAIL);
        $titulo =  filter_var($postVars['titulo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $resumo =  filter_var($postVars['resumo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $telefone =  filter_var($postVars['telefone'],FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade =  filter_var($postVars['cidade'],FILTER_SANITIZE_SPECIAL_CHARS);
        $estado = $postVars['estado'];
        $ingles = $postVars['ingles'];
        //$foto = $postVars['foto'];
        
        $model = new ModelsCandidato();
        $model->setNome($nome);
        $model->setEmail($email);
        $model->setTitulo($titulo);
        $model->setResumo($resumo);
        $model->setTelefone($telefone);
        $model->setCidade($cidade);
        $model->setEstado($estado);
        $model->setNivelIngles($ingles);
        $model->setId($id);
        //$model->setFoto($foto);
        
        try{
            if(($model->update())){
                $request->getRouter()->redirect("/candidatos/{$id}/perfil/editar?status=updated");
            }else{
                $request->getRouter()->redirect("/candidatos/{$id}/perfil/editar?status=error");
            }

        }catch(Exception $ex)
        {   echo "<pre>";
            print_r($ex->getMessage());
            echo "</pre>";
            exit;
            $request->getRouter()->redirect("/candidatos/{$id}/perfil/editar?status=error");
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