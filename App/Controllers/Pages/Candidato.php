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
                "candidato" => $candidato,
                'formacoes' => $candidato->getFormacoes($id),
                "cursos"    => $candidato->getCursos($id)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA :".$ex->getMessage(),404);
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
                'foto'=>$candidato->getFoto(),
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
                'foto'=>$postVars['old_foto'],
                'status' => Alert::getError("Preencha os campos obrigatórios")
            ]);
        }

        if(uploaded_foto() && !is_valid_foto()){
            return View::render("candidatos::editar",[
                "nome" => $postVars['nome'],
                'email' =>$postVars['email'],
                'titulo'=>$postVars['titulo'],
                'resumo'=>$postVars['resumo'],
                'telefone'=>$postVars['telefone'],
                'estado'=>$postVars['estado'],
                'ingles'=>$postVars['ingles'],
                'cidade'=>$postVars['cidade'],
                'foto'=>$postVars['old_foto'],
                'status' => Alert::getError("Formato da Imagem Invalido")
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
        if(!uploaded_foto()){
            $foto = $postVars['old_foto'];
        }else{
            $foto = get_uploaded_foto();
        }
        
        

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
        $model->setFoto($foto);

        
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



    public static function getAdicionarFormacao($request,$id)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("candidatos::add_formacao",[
                "id" => $id,
                "curso" => '',"escola"=>'',"inicio"=>'',"fim"=>'',
                "status"=> self::getStatus($request)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }

    public static function setAdicionarFormacao($request,$id)
    {
        $postVars = $request->getPostVars();

        $curso = filter_var($postVars['curso'],FILTER_SANITIZE_SPECIAL_CHARS);
        $nivel = filter_var($postVars['nivel'],FILTER_SANITIZE_SPECIAL_CHARS);
        $escola = filter_var($postVars['escola'],FILTER_SANITIZE_SPECIAL_CHARS);
        $incio = filter_var($postVars['inicio'],FILTER_SANITIZE_SPECIAL_CHARS);
        $fim = filter_var($postVars['fim'],FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($curso) || empty($nivel) || empty($escola)){
            return View::render("candidatos::add_formacao",[
                "curso" => $curso,"escola"=>$escola,"inicio"=>$incio,"fim"=>$fim
            ]);
        }

        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }

            if($candidato->addFormacao($nivel,$curso,$escola,$incio,$fim,$id)){
                $request->getRouter()->redirect("/candidatos/{$id}/formacao/adicionar?status=updated");
            }else{
                return View::render("candidatos::add_formacao",[
                    "id" => $id,
                    "curso" => $curso,
                    "nivel" => $nivel,
                    "escola"=> $escola,
                    "inicio"=>$incio,
                    "fim"   => $fim,
                    "status"=> "Ocorreu um Erro ao Cadastrar Formação"
                ]);
            }
            

        }catch(Exception $ex)
        {   
            echo "<pre>";
            print_r($ex->getMessage());
            echo "</pre>";
            exit;
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }

    }

    public static function getAdicionarCurso($request,$id)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("candidatos::add_curso",[
                "id" => $id,
                "nome" => '',"escola"=>'',"conclusao"=>'',
                "status"=> self::getStatus($request)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }

    public static function setAdicionarCurso($request,$id)
    {
        $postVars = $request->getPostVars();

        $nome = filter_var($postVars['nome'],FILTER_SANITIZE_SPECIAL_CHARS);
        $data = filter_var($postVars['conclusao'],FILTER_SANITIZE_SPECIAL_CHARS);
        $escola = filter_var($postVars['escola'],FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(empty($nome) || empty($data) || empty($escola)){
            return View::render("candidatos::add_curso",[
                "nome" => $nome,"escola"=>$escola,"conclusao"=>$data,
                "status"=>Alert::getError("Preencha os campos obrigatórios!")
            ]);
        }
        if(uploaded_file("certificado") && !is_valid_file("certificado")){
            return View::render("candidatos::add_curso",[
                "nome" => $nome,"escola"=>$escola,"conclusao"=>$data,
                "status"=>Alert::getError("Formato de arquivo nao permitido!")
            ]);
        }
        $certificado = get_uploaded_file("certificado");
        if($certificado == null){
            return View::render("candidatos::add_curso",[
                "nome" => $nome,"escola"=>$escola,"conclusao"=>$data,
                "status"=>Alert::getError("Falha ao carregar arquivo!")
            ]);
        }

        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }

            if($candidato->addCurso($nome,$escola,$certificado,$data,$id)){
                $request->getRouter()->redirect("/candidatos/{$id}/cursos/adicionar?status=updated");
            }else{
                return View::render("candidatos::add_curso",[
                    "id" => $id,
                    "nome" => $nome,
                    "conclusao" => $data,
                    "escola"=> $escola,
                    "status"=> "Ocorreu um Erro ao Cadastrar Curso"
                ]);
            }
            

        }catch(Exception $ex)
        {   
            echo "<pre>";
            print_r($ex->getMessage());
            echo "</pre>";
            exit;
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