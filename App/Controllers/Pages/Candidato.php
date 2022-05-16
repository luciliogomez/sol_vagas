<?php
namespace App\Controllers\Pages;

use App\Models\Candidato as ModelsCandidato;
use App\Utils\Alert;
use App\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;
use Exception;

class Candidato extends PagesBaseController{


    public static function getLogin($request)
    {
        return View::render("candidatos::login",[
            "status" => self::getStatus($request)
        ]);
    }

    public static function getCadastro($request)
    {
        return View::render("candidatos::cadastro",[
            "status" => self::getStatus($request),
            "nome"   => '',
            "email"  => ''
        ]);
    }

    public static function setCadastro($request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['nome']) || empty($postVars['email']) || empty($postVars['senha']))
        {
            $request->getRouter()->redirect("/candidatos/cadastro?status=empty");
        }

        $nome = filter_var($postVars['nome'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($postVars['email'],FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_var($postVars['senha'],FILTER_SANITIZE_SPECIAL_CHARS);
        
        $model = new ModelsCandidato();

        try{

            $candidato = $model->loadByEmail($email);
            if($candidato instanceof ModelsCandidato)
            {
                return View::render("candidatos::cadastro",[
                    "nome"  => $nome,
                    "email" => $email,
                    "senha" => $senha,
                    "status"=> Alert::getError("Email Já Em Uso. Faça Login")
                ]);
            }

            $model->setNome($nome);
            $model->setEmail($email);
            $model->setSenha(password_hash($senha,PASSWORD_DEFAULT));

            if( ($id = $model->create()) != null){
                $_SESSION['usuario']["id"] = $id;
                $_SESSION['usuario']["nome"] = $nome;
                $_SESSION['usuario']["email"] = $email;
                $_SESSION['usuario']["tipo"] = "candidatos";
                $_SESSION['usuario']["foto"] = '';
                $_SESSION['usuario']["area"] = '';
                $_SESSION['usuario']["titulo"] = '';
  
                $request->getRouter()->redirect("/candidatos/{$id}/dashboard");
            
            }

        }catch(Exception $ex)
        {
            echo "<pre>";
print_r($ex->getMessage());
echo "</pre>";
exit;
            throw new Exception("PAGINA NÃO ENCONTRADA",404);
        }
        return View::render("candidatos::cadastro",[
            "status" => self::getStatus($request),
            "nome"   => '',
            "email"  => ''
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
                $_SESSION['usuario']["area"] = $candidato->getArea();
                $_SESSION['usuario']["titulo"] = $candidato->getTitulo();
  
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
                "cursos"    => $candidato->getCursos($id),
                "experiencias"=>$candidato->getExperiencias($id)
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
                "id" => $id,
                "nome" => $candidato->getNome(),
                'email' =>$candidato->getEmail(),
                'titulo'=>$candidato->getTitulo(),
                'resumo'=>$candidato->getResumo(),
                'telefone'=>$candidato->getTelefone(),
                'estado'=>$candidato->getEstado(),
                'ingles'=>$candidato->getNivelIngles(),
                'cidade'=>$candidato->getCidade(),
                'foto'=>$candidato->getFoto(),
                "area"=> $candidato->getArea(),
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
                "area"  => $postVars['area'],
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
                "area"  => $postVars['area'],
                'foto'=>$postVars['old_foto'],
                'status' => Alert::getError("Formato da Imagem Invalido")
            ]);
        }

        $nome =   filter_var($postVars['nome'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email =  filter_var($postVars['email'],FILTER_SANITIZE_EMAIL);
        $titulo = filter_var($postVars['titulo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $resumo = filter_var($postVars['resumo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $telefone =  filter_var($postVars['telefone'],FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade = filter_var($postVars['cidade'],FILTER_SANITIZE_SPECIAL_CHARS);
        $estado = $postVars['estado'];
        $ingles = $postVars['ingles'];
        $area   = $postVars['area'];
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
        $model->setArea($area);
        
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

    public static function getEditarFormacao($request,$id,$id_formacao)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            $formacao = $candidato->getFormacoes($id,$id_formacao);
            if($formacao == null){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("candidatos::edit_formacao",[
                "id" => $id,
                "id_formacao" => $id_formacao,
                "curso" => $formacao['curso'],"escola"=>$formacao['escola'],
                "nivel"=>$formacao['nivel'],"inicio"=>$formacao['inicio'],"fim"=>$formacao['fim'],
                "status"=> self::getStatus($request)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }

    public static function setEditarFormacao($request,$id,$id_formacao)
    {
        $postVars = $request->getPostVars();

        $curso = filter_var($postVars['curso'],FILTER_SANITIZE_SPECIAL_CHARS);
        $nivel = filter_var($postVars['nivel'],FILTER_SANITIZE_SPECIAL_CHARS);
        $escola = filter_var($postVars['escola'],FILTER_SANITIZE_SPECIAL_CHARS);
        $incio = filter_var($postVars['inicio'],FILTER_SANITIZE_SPECIAL_CHARS);
        $fim = filter_var($postVars['fim'],FILTER_SANITIZE_SPECIAL_CHARS);
        

        if(empty($curso) || empty($nivel) || empty($escola)){
            return View::render("candidatos::edit_formacao",[
                "curso" => $curso,"escola"=>$escola,"inicio"=>$incio,"fim"=>$fim
            ]);
        }

        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }

            if($candidato->updateFormacao($nivel,$curso,$escola,$incio,$fim,$id_formacao)){
                $request->getRouter()->redirect("/candidatos/{$id}/formacao/{$id_formacao}/editar?status=updated");
            }else{
                return View::render("candidatos::edit_formacao",[
                    "id" => $id,
                    "curso" => $curso,
                    "nivel" => $nivel,
                    "escola"=> $escola,
                    "inicio"=>$incio,
                    "fim"   => $fim,
                    "status"=> "Ocorreu um Erro ao Actualizar Formação"
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

    public static function getEliminarFormacao($request,$id,$id_formacao)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            $formacao = $candidato->getFormacoes($id,$id_formacao);
            if($formacao == null){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            if($model->deleteFormacao($id_formacao)){
                $request->getRouter()->redirect("/candidatos/{$id}/perfil");
            }else{
                return View::render("candidatos::edit_formacao",[
                    "id" => $id,
                    "curso" => $formacao['curso'],
                    "nivel" => $formacao['nivel'],
                    "escola"=> $formacao['escola'],
                    "inicio"=>$formacao['inicio'],
                    "fim"   => $formacao['fim'],
                    "status"=> "Ocorreu um Erro ao Eliminar Formação"
                ]);
            }

        }catch(Exception $ex)
        {   
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


    public static function getEditarCurso($request,$id,$id_curso)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            $curso = $candidato->getCursos($id,$id_curso);
            if($curso == null){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("candidatos::edit_curso",[
                "id" => $id,
                "id_curso" => $id_curso,
                "nome" => $curso['nome'],"escola"=>$curso['escola'],
                "certificado"=>$curso['certificado'],"conclusao"=>$curso['data_conclusao'],
                "status"=> self::getStatus($request)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }

    public static function setEditarCurso($request,$id,$id_curso)
    {
        $postVars = $request->getPostVars();
        
        $nome = filter_var($postVars['nome'],FILTER_SANITIZE_SPECIAL_CHARS);
        $escola = filter_var($postVars['escola'],FILTER_SANITIZE_SPECIAL_CHARS);
        $fim = filter_var($postVars['conclusao'],FILTER_SANITIZE_SPECIAL_CHARS);
        
        $model = new ModelsCandidato();
        $curso = $model->getCursos($id,$id_curso);

        if(empty($nome) || empty($escola) || empty($fim)){
            return View::render("candidatos::edit_curso",[
                "nome" => $nome,"escola"=>$escola,"conclusao"=>$fim,
                "status" => Alert::getError("Preencha os campos obrigatorios")
            ]);
        }
        if(uploaded_file("certificado") && !is_valid_file("certificado")){
            return View::render("candidatos::edit_curso",[
                "nome" => $nome,"escola"=>$escola,"conclusao"=>$fim,
                "status"=>Alert::getError("Formato de arquivo nao permitido!")
            ]);
        }
        $certificado = uploaded_file("certificado")?get_uploaded_file("certificado"):$curso['certificado'];
        if(uploaded_file("certificado") && $certificado == null){
            return View::render("candidatos::edit_curso",[
                "nome" => $nome,"escola"=>$escola,"conclusao"=>$fim,
                "status"=>Alert::getError("Falha ao carregar arquivo!")
            ]);
        }

        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }

            if($candidato->updateCurso($nome,$escola,$certificado,$fim,$id_curso)){
                $request->getRouter()->redirect("/candidatos/{$id}/curso/{$id_curso}/editar?status=updated");
            }else{
                echo "<pre>";
            print_r($certificado);
            echo "</pre>";
            exit;
                return View::render("candidatos::edit_curso",[
                    "id" => $id,
                    "nome" => $nome,
                    "certificado" => $certificado,
                    "escola"=> $escola,
                    "conclusao"   => $fim,
                    "status"=> Alert::getError("Ocorreu um Erro ao Actualizar Curso")
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

    public static function getEliminarCurso($request,$id,$id_curso)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            $curso = $candidato->getCursos($id,$id_curso);
            if($curso == null){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            if($model->deleteCurso($id_curso)){
                $request->getRouter()->redirect("/candidatos/{$id}/perfil");
            }else{
                return View::render("candidatos::edit_curso",[
                    "id" => $id,
                    "certificado" => $curso['certificado'],
                    "nome" => $curso['nome'],
                    "escola"=> $curso['escola'],
                    "conclusao"   => $curso['data_conclusao'],
                    "status"=> "Ocorreu um Erro ao Eliminar Formação"
                ]);
            }

        }catch(Exception $ex)
        {   echo "<pre>";
            print_r($ex->getMessage());
            echo "</pre>";
            exit;
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }

    // EXPERIENCIAS
    public static function getAdicionarExperiencia($request,$id)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("candidatos::add_experiencia",[
                "id" => $id,
                "cargo" => '',"empresa"=>'',"descricao"=>'',"inicio"=>'',"fim"=>'',
                "status"=> self::getStatus($request)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }

    public static function setAdicionarExperiencia($request,$id)
    {
        $postVars = $request->getPostVars();

        $cargo = filter_var($postVars['cargo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $empresa = filter_var($postVars['empresa'],FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao = filter_var($postVars['descricao'],FILTER_SANITIZE_SPECIAL_CHARS);
        $inicio = filter_var($postVars['inicio'],FILTER_SANITIZE_SPECIAL_CHARS);
        $fim = filter_var($postVars['fim'],FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($cargo) || empty($empresa) || empty($descricao) || empty($inicio)){
            return View::render("candidatos::add_experiencia",[
                "cargo" => $cargo,"empresa"=>$empresa,"dscricao"=>$descricao,"inicio"=>$inicio,"fim"=>$fim
            ]);
        }

        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }

            if($candidato->addExperiencia($cargo,$empresa,$descricao,$inicio,$fim,$id)){
                $request->getRouter()->redirect("/candidatos/{$id}/experiencia/adicionar?status=updated");
            }else{
                return View::render("candidatos::add_experiencia",[
                    "id" => $id,
                    "cargo" => $cargo,
                    "empresa" => $empresa,
                    "descricao"=> $descricao,
                    "inicio"=>$inicio,
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


    public static function getEditarExperiencia($request,$id,$id_experiencia)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            $experiencia = $candidato->getExperiencias($id,$id_experiencia);
            if($experiencia == null){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("candidatos::edit_experiencia",[
                "id" => $id,
                "id_experiencia" => $id_experiencia,
                "cargo" => $experiencia['cargo'],"empresa"=>$experiencia['empresa'],
                "descricao" => $experiencia['descricao'],
                "inicio"=>$experiencia['inicio'],"fim"=>$experiencia['fim'],
                "status"=> self::getStatus($request)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }

    public static function setEditarExperiencia($request,$id,$id_experiencia)
    {
        $postVars = $request->getPostVars();

        $cargo = filter_var($postVars['cargo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $empresa = filter_var($postVars['empresa'],FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao = filter_var($postVars['descricao'],FILTER_SANITIZE_SPECIAL_CHARS);
        $inicio = filter_var($postVars['inicio'],FILTER_SANITIZE_SPECIAL_CHARS);
        $fim = filter_var($postVars['fim'],FILTER_SANITIZE_SPECIAL_CHARS);
        

        if(empty($cargo) || empty($empresa) || empty($inicio) || empty($descricao)){
            return View::render("candidatos::edit_experiencia",[
                "curso" => $cargo,"empresa"=>$empresa,"inicio"=>$inicio,"fim"=>$fim,
                "descricao"=>$descricao,
                "status"=>Alert::getError("Preencha os campos obrigatorios")
            ]);
        }

        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }

            if($candidato->updateExperiencia($cargo,$empresa,$descricao,$inicio,$fim,$id_experiencia)){
                $request->getRouter()->redirect("/candidatos/{$id}/experiencia/{$id_experiencia}/editar?status=updated");
            }else{
                return View::render("candidatos::edit_experiencia",[
                    "id" => $id,
                    "cargo" => $cargo,
                    "empresa" => $empresa,
                    "descricao"=> $descricao,
                    "inicio"=>$inicio,
                    "fim"   => $fim,
                    "status"=> Alert::getError("Ocorreu um Erro ao Actualizar Experiencia")
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

    public static function getEliminarExperiencia($request,$id,$id_experiencia)
    {
        $model = new ModelsCandidato();
        try{
            $candidato = $model->load($id);
            if(!($candidato instanceof ModelsCandidato)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            $experiencia = $candidato->getExperiencias($id,$id_experiencia);
            if($experiencia == null){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            if($model->deleteExperiencia($id_experiencia)){
                $request->getRouter()->redirect("/candidatos/{$id}/perfil");
            }else{
                return View::render("candidatos::edit_experiencia",[
                    "id" => $id,
                    "cargo" => $experiencia['cargo'],
                    "empresa" => $experiencia['empresa'],
                    "descricao"=>$experiencia['descricao'],
                    "inicio"=>$experiencia['inicio'],
                    "fim"   => $experiencia['fim'],
                    "status"=> Alert::getError("Ocorreu um Erro ao Eliminar Experiencia")
                ]);
            }

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }
    }


    public static function getCandidaturas($request,$id)
    {
        $model = new ModelsCandidato();
        $queryParams = $request->getQueryParams();
        $candidaturas = [];
        $pagination = null;

        try{
            $candidato = $model->load($id);
            if(!($candidato  instanceof ModelsCandidato)){
                throw new Exception("PAGINA NÃO ENCONTRADA",404);
            }
            $total = count($model->getCandidaturas($id));

            $page = $queryParams['page']?? '1';
            
            $pagination = new Pagination($total,$page,4);

            $candidaturas = $model->getCandidaturas($id,$pagination->getLimit());
        
            
        }catch(Exception $e)
        {
            
            $candidaturas = [];
            $pagination = null;
        }

        return View::render("candidatos::candidaturas",[
            "candidaturas" => $candidaturas,
            "links"        => self::getPagination($pagination,$request)
        ]);
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