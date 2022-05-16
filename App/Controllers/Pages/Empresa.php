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

    public static function getEditPerfil($request,$id)
    {
        $model = new ModelsEmpresa();
        try{
            $empresa = $model->load($id);
            if(!($empresa instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("empresas::editar",[
                "empresa" => $empresa,
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
            || empty($postVars['cidade'])|| empty($postVars['telefone']) || empty($postVars['ano'])   
        ){
            return View::render("empresas::editar",[
                "nome" => $postVars['nome'],
                'email' =>$postVars['email'],
                'ano'=>$postVars['ano'],
                'resumo'=>$postVars['resumo'],
                'telefone'=>$postVars['telefone'],
                'cidade'=>$postVars['cidade'],
                'foto'=>$postVars['old_foto'],
                'status' => Alert::getError("Preencha os campos obrigatórios")
            ]);
        }

        if(uploaded_foto() && !is_valid_foto()){
            return View::render("empresas::editar",[
                "nome" => $postVars['nome'],
                'email' =>$postVars['email'],
                'ano'=>$postVars['ano'],
                'resumo'=>$postVars['resumo'],
                'telefone'=>$postVars['telefone'],
                'cidade'=>$postVars['cidade'],
                'foto'=>$postVars['old_foto'],
                'status' => Alert::getError("Formato da Imagem Invalido")
            ]);
        }

        $nome =   filter_var($postVars['nome'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email =  filter_var($postVars['email'],FILTER_SANITIZE_EMAIL);
        $ano = filter_var($postVars['ano'],FILTER_SANITIZE_SPECIAL_CHARS);
        $resumo = filter_var($postVars['resumo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $telefone =  filter_var($postVars['telefone'],FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade = filter_var($postVars['cidade'],FILTER_SANITIZE_SPECIAL_CHARS);
        if(!uploaded_foto()){
            $foto = $postVars['old_foto'];
        }else{
            $foto = get_uploaded_foto();
        }
        
        $model = new ModelsEmpresa();
        $model->setNome($nome);
        $model->setEmail($email);
        $model->setAnoFundacao($ano);
        $model->setDescricao($resumo);
        $model->setTelefone($telefone);
        $model->setCidade($cidade);
        $model->setId($id);
        $model->setLogo($foto);
        
        try{
            if(($model->update())){
                $request->getRouter()->redirect("/empresas/{$id}/perfil/editar?status=updated");
            }else{
                $request->getRouter()->redirect("/empresas/{$id}/perfil/editar?status=error");
            }

        }catch(Exception $ex)
        {   echo "<pre>";
            print_r($ex->getMessage());
            echo "</pre>";
            exit;
            $request->getRouter()->redirect("/empresas/{$id}/perfil/editar?status=error");
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