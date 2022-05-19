<?php
namespace App\Controllers\Pages;

use App\Utils\Alert;
use App\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;
use App\Controllers\Pages\PagesBaseController;
use App\Models\Candidato;
use App\Models\Empresa as ModelsEmpresa;
use App\Models\Vaga;
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

    public static function getCadastro($request)
    {
        return View::render("empresas::cadastro",[
            "status" => self::getStatus($request),
            "nome"   => 'cadastre o se nome',
            "email"  => '',
            "senha"  => ''
        ]);
    }

    public static function setCadastro($request)
    {  
        $postVars = $request->getPostVars();
        if(empty($postVars['nome']) || empty($postVars['email']) || empty($postVars['senha']))
        {
            $request->getRouter()->redirect("/empresas/cadastro?status=empty");
        }

        $nome = filter_var($postVars['nome'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($postVars['email'],FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_var($postVars['senha'],FILTER_SANITIZE_SPECIAL_CHARS);
        
        $model = new ModelsEmpresa();

        try{

            $empresa = $model->loadByEmail($email);
            if($empresa instanceof ModelsEmpresa)
            {
                return View::render("empresas::cadastro",[
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
                $_SESSION['usuario']["tipo"] = "empresas";
                $_SESSION['usuario']["logotipo"] = null;
  
                $request->getRouter()->redirect("/empresas/{$id}/dashboard");
            
            }

        }catch(Exception $ex)
        {
            echo "<pre>";
print_r($ex->getMessage());
echo "</pre>";
exit;
            throw new Exception("PAGINA NÃO ENCONTRADA",404);
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


    
    public static function getCandidaturas($request,$id)
    {
        $model = new ModelsEmpresa();
        $queryParams     = $request->getQueryParams();
        $candidaturas = [];
        $vagas = [];
        $pagination = null;
        try{
            $empresa = $model->load($id);
            if(!($empresa  instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NÃO ENCONTRADA",404);
            }
            $total = count($model->getCandidaturas($id));

            $page = $queryParams['page']?? '1';
            
            $pagination = new Pagination($total,$page,1);

            $candidaturas = $model->getCandidaturas($id,$pagination->getLimit());

            $vagas = $empresa->getVagas($empresa->getId());
      
        }catch(Exception $e)
        {
            $candidaturas = [];
            $pagination = null;
        }
        return View::render("empresas::candidaturas",[
            "candidaturas" => $candidaturas,
            "empresa"      => $empresa,
            "links"        => self::getPagination($pagination,$request),
            "vagas"        => $vagas
        ]);
    }

    public static function getFilteredCandidaturas($request,$id)
    {
        $model = new ModelsEmpresa();
        $queryParams     = $request->getQueryParams();
        $postVars = $request->getPostVars();
        $id_vaga = $postVars['vaga'];
   
        $request->getRouter()->redirect("/empresas/{$id}/candidaturas/filter?search={$id_vaga}");
        
    }

    public static function filtrarCandidaturas($request,$id)
    {
        $model = new ModelsEmpresa();
        $queryParams     = $request->getQueryParams();
        $id_vaga = $queryParams['search'];
        $candidaturas = [];
        $vagas = [];
        $pagination = null;
        try{
            $empresa = $model->load($id);
            if(!($empresa  instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NÃO ENCONTRADA",404);
            }
            $total =($id_vaga == 'all')?count($model->getCandidaturas($id)): count($model->getCandidaturasByVagas($id,$id_vaga));

            $page = $queryParams['page']?? '1';
            
            $pagination = new Pagination($total,$page,1);

            $candidaturas = ($id_vaga == 'all')? $model->getCandidaturas($id,$pagination->getLimit()): $model->getCandidaturasByVagas($id,$id_vaga,$pagination->getLimit());

            $vagas = $empresa->getVagas($empresa->getId());
        }catch(Exception $e)
        {
            $candidaturas = [];
            $pagination = null;
        }
        return View::render("empresas::candidaturas",[
            "candidaturas" => $candidaturas,
            "empresa"      => $empresa,
            "links"        => self::getPagination($pagination,$request,$id_vaga),
            "vagas"        => $vagas
        ]);
    }

    public static function getCandidaturaDetalhes($request,$id,$id_candidatura)
    { 
        $model = new ModelsEmpresa();
        $vagaModel = new Vaga();
        $candidatoModel = new Candidato();
        
        try{
            $empresa = $model->load($id);
            if(!($empresa  instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NÃO ENCONTRADA",404);
            }
            $candidatura = $model->getCandidaturaOne($id_candidatura);
            if(($candidatura  == null)){
                throw new Exception("PAGINA NÃO ENCONTRADA - Candidatura Inválida",404);
            }
            $candidato = $candidatoModel->load($candidatura['id_candidato']);
            if(($candidato  == null)){
                throw new Exception("PAGINA NÃO ENCONTRADA - Candidato Não Encontrado",404);
            }

            $vaga = $vagaModel->load($candidatura['id_vaga']);
            if(($vaga  == null)){
                throw new Exception("PAGINA NÃO ENCONTRADA - Vaga Não Encontrada",404);
            }

            return View::render("empresas::show_candidatura",[
                "candidatura" => $candidatura,
                "empresa"     => $empresa,
                "vaga"        => $vaga,
                "candidato"   => $candidato
            ]);

            
        }catch(Exception $e)
        {
            echo "<pre>";
print_r($e->getMessage());
echo "</pre>";
exit;
            throw new Exception("PAGINA NÃO ENCONTRADA",404);
        }
    }

    public static function getMarcarEntrevista($request,$id,$id_candidatura)
    {
        $model = new ModelsEmpresa();
        $vagaModel = new Vaga();
        $candidatoModel = new Candidato();
     
        try{
            $empresa = $model->load($id);
            if(!($empresa  instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NÃO ENCONTRADA",404);
            }
            $candidatura = $model->getCandidaturaOne($id_candidatura);
            if(($candidatura  == null)){
                throw new Exception("PAGINA NÃO ENCONTRADA - Candidatura Inválida",404);
            }
            $candidato = $candidatoModel->load($candidatura['id_candidato']);
            if(($candidato  == null)){
                throw new Exception("PAGINA NÃO ENCONTRADA - Candidato Não Encontrado",404);
            }

            $vaga = $vagaModel->load($candidatura['id_vaga']);
            if(($vaga  == null)){
                throw new Exception("PAGINA NÃO ENCONTRADA - Vaga Não Encontrada",404);
            }

            return View::render("empresas::entrevista",[
                "candidatura" => $candidatura,
                "empresa"     => $empresa,
                "vaga"        => $vaga,
                "candidato"   => $candidato,
                "status"      => ''
            ]);

            
        }catch(Exception $e)
        {
            echo "<pre>";
print_r($e->getMessage());
echo "</pre>";
exit;
            throw new Exception("PAGINA NÃO ENCONTRADA",404);
        }
    }
    public static function setMarcarEntrevista($request,$id,$id_candidatura)
    {
        $model = new ModelsEmpresa();
        $vagaModel = new Vaga();
        $candidatoModel = new Candidato();
        $postVars= $request->getPostVars();

        $data = $postVars['data'];
        $hora = $postVars['hora'];
        $modalidade = $postVars['modalidade'];
        $endereco = $postVars['endereco'];
        $corpo = $postVars['corpo'];
    
        try{
            $empresa = $model->load($id);
            if(!($empresa  instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NÃO ENCONTRADA",404);
            }
            $candidatura = $model->getCandidaturaOne($id_candidatura);
            if(($candidatura  == null)){
                throw new Exception("PAGINA NÃO ENCONTRADA - Candidatura Inválida",404);
            }
            $candidato = $candidatoModel->load($candidatura['id_candidato']);
            if(($candidato  == null)){
                throw new Exception("PAGINA NÃO ENCONTRADA - Candidato Não Encontrado",404);
            }

            $vaga = $vagaModel->load($candidatura['id_vaga']);
            if(($vaga  == null)){
                throw new Exception("PAGINA NÃO ENCONTRADA - Vaga Não Encontrada",404);
            }
            if(empty($corpo) || empty($data) || empty($hora)){
                return View::render("empresas::entrevista",[
                    "candidatura" => $candidatura,
                    "empresa"     => $empresa,
                    "vaga"        => $vaga,
                    "candidato"   => $candidato,
                    "status"      => Alert::getError('Preencha os campos obrigatórios'),
                    "data"        => $data,
                    "hora"        => $hora,
                    "corpo"       => $corpo,
                    "modalidade"  => $modalidade,
                    "endereco"    => $endereco
                ]);
            }

            if($modalidade == 1 &&  empty($endereco)){
                return View::render("empresas::entrevista",[
                    "candidatura" => $candidatura,
                    "empresa"     => $empresa,
                    "vaga"        => $vaga,
                    "candidato"   => $candidato,
                    "data"        => $data,
                    "hora"        => $hora,
                    "corpo"       => $corpo,
                    "modalidade"  => $modalidade,
                    "endereco"    => $endereco,
                    "status"      => Alert::getError('Precisa indicar o Endereço para uma entrevista presencial')
                ]);
            }

            return self::enviarConvite($data,$hora,$modalidade,$endereco,$corpo,$vaga);

            
        }catch(Exception $e)
        {
            echo "<pre>";
print_r($e->getMessage());
echo "</pre>";
exit;
            throw new Exception("PAGINA NÃO ENCONTRADA",404);
        }
    }

    public static function enviarConvite($data,$hora,$modalidade,$endereco,$corpo,$vaga)
    {
        $texto = " 
        <p> Você foi selecionado para entrevista. <br/></p>
        <div class='mt-1 mb-2 br-4 blue pa-1 rad-3 w-50 text-size-small-1'>
        <p class='mb-1'> Vaga: <span class='text-white'>{$vaga->getTitulo()}</span> <br/></p>
        <p class='mb-1'> Empresa: <span class='text-white'>{$vaga->getEmpresa()}</span> <br/></p>
        <p class='mb-1'> Data da Entrevista: <span class='text-white'>{$data}</span> <br/></p>
        <p class='mb-1'> Modalidade: <span class='text-white'>{$modalidade}</span> <br/></p>
        <p class='mb-1'> Hora: <span class='text-white'>{$hora}</span> <br/></p>". (!empty($endereco)?"<p> Endereço: <span>{$endereco}</span> <br/></p>":""). 
        "</div>
        <p class='text-size-small-1 text-center'>{$corpo}</p>";
        return View::render("empresas::convite",[
            "texto" => $texto,
            "vaga"  => $vaga
        ]);
    }

    public static function getVagas($request,$id)
    {
        $model = new ModelsEmpresa();
        $queryParams     = $request->getQueryParams();
        $vagas = [];
        $pagination = null;
        try{
            $empresa = $model->load($id);
            if(!($empresa  instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NÃO ENCONTRADA",404);
            }

            $total =count($empresa->getVagas($empresa->getId()));

            $page = $queryParams['page']?? '1';
            
            $pagination = new Pagination($total,$page,1);

            $vagas = $empresa->getVagas($empresa->getId(),$pagination->getLimit());

        }catch(Exception $e)
        {
            $vgas= [];
            $pagination = null;
        }
        return View::render("empresas::vagas",[
            "empresa"      => $empresa,
            "links"        => self::getPagination($pagination,$request),
            "vagas"        => $vagas
        ]);
    }


    public static function getFilteredVagas($request,$id)
    {
        $model = new ModelsEmpresa();
        $queryParams     = $request->getQueryParams();
        $postVars = $request->getPostVars();
        $estado = $postVars['estado'];
   
        $request->getRouter()->redirect("/empresas/{$id}/vagas/filter?search={$estado}");
        
    }

    public static function filtrarVagas($request,$id)
    {
        $model = new ModelsEmpresa();
        $queryParams     = $request->getQueryParams();
        $estado = $queryParams['search'];
        $vagas = [];
        $pagination = null;
        try{
            $empresa = $model->load($id);
            if(!($empresa  instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NÃO ENCONTRADA",404);
            }
            $total =count($empresa->getVagasByEstado($empresa->getId(),$estado));

            $page = $queryParams['page']?? '1';
            
            $pagination = new Pagination($total,$page,1);

            $vagas = $empresa->getVagasByEstado($empresa->getId(),$estado,$pagination->getLimit());
        }catch(Exception $e)
        {
            $vagas = [];
            $pagination = null;
        }
        return View::render("empresas::vagas",[
            "empresa"      => $empresa,
            "links"        => self::getPagination($pagination,$request,$estado),
            "vagas"        => $vagas,
            "estado"       => $estado
        ]);
    }


    public static function getPublicarVaga($request,$id)
    {
        $model = new ModelsEmpresa();
        try{
            $empresa = $model->load($id);
            if(!($empresa instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }

            return View::render("vagas::novo",[
                "id_empresa" => $id,
                'status' => self::getStatus($request)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }

    }

    
    public static function setPublicarVaga($request,$id)
    {
        $postVars = $request->getPostVars();
        

        if( empty($postVars['titulo']) || empty($postVars['cidade']) 
            || empty($postVars['fim']) 
            || empty($postVars['descricao'] ) ||  empty($postVars['habilidades'] )   
        ){
            return View::render("vagas::novo",[
                "titulo" => $postVars['titulo'],
                'cidade' =>$postVars['cidade'],
                'anos'=>$postVars['anos'],
                'descricao'=>$postVars['descricao'],
                'habilidades'=>$postVars['habilidades'],
                'fim'=>$postVars['fim'],
                'area'=>$postVars['area'],
                'formato'=>$postVars['formato'],
                'modalidade'=>$postVars['modalidade'],
                'salario_min'=>$postVars['salario_min'],
                'salario_max'=>$postVars['salario_max'],
                'status' => Alert::getError("Preencha os campos obrigatórios"),
                "id_empresa" => $id
            ]);
        }

        $titulo =   filter_var($postVars['titulo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade =   filter_var($postVars['cidade'],FILTER_SANITIZE_SPECIAL_CHARS);
        $anos =   filter_var($postVars['anos'],FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao =   filter_var($postVars['descricao'],FILTER_SANITIZE_SPECIAL_CHARS);
        $habilidades =   filter_var($postVars['habilidades'],FILTER_SANITIZE_SPECIAL_CHARS);
        $fim=   filter_var($postVars['fim'],FILTER_SANITIZE_SPECIAL_CHARS);
        $area=   filter_var($postVars['area'],FILTER_SANITIZE_SPECIAL_CHARS);
        $formato =  filter_var($postVars['formato'],FILTER_SANITIZE_EMAIL);
        $modalidade = filter_var($postVars['modalidade'],FILTER_SANITIZE_SPECIAL_CHARS);
        $salario_min= filter_var($postVars['salario_min'],FILTER_SANITIZE_SPECIAL_CHARS);
        $salario_max =  filter_var($postVars['salario_max'],FILTER_SANITIZE_SPECIAL_CHARS);
        $id_empresa = $postVars['id_empresa'];
        $nivel = filter_var($postVars['nivel'],FILTER_SANITIZE_EMAIL);

        $model = new Vaga();
        $model->setTitulo($titulo);
        $model->setCidade($cidade);
        $model->setAnos($anos);
        $model->setDescricao($descricao);
        $model->setHabilidades($habilidades);
        $model->setLimite($fim);
        $model->setFormato($formato);
        $model->setModalidade($modalidade);
        $model->setSalarioMin($salario_min);
        $model->setSalarioMax($salario_max);
        $model->setIdEmpresa($id_empresa);
        $model->setArea($area);
        $model->setEducacao($nivel);
        $model->setEstado(1);
        
        try{
            if(($model->create())){
                $request->getRouter()->redirect("/empresas/{$id}/vagas/nova?status=updated");
            }else{
                $request->getRouter()->redirect("/empresas/{$id}/vagas/nova?status=error");
            }

        }catch(Exception $ex)
        {   echo "<pre>";
            print_r($ex->getMessage());
            echo "</pre>";
            exit;
            $request->getRouter()->redirect("/empresas/{$id}/vagas/nova?status=error");
        }
    
    }



    public static function getEditarVaga($request,$id)
    {
        $model = new ModelsEmpresa();
        $vagaModel = new Vaga();

        try{
            $empresa = $model->load($id);
            if(!($empresa instanceof ModelsEmpresa)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            $vaga = $vagaModel->load($id);
            if(!($vaga instanceof Vaga)){
                throw new Exception("PAGINA NAO ENCONTRADA",404);
            }
            return View::render("vagas::edit",[
                "vaga" => $vaga,
                'status' => self::getStatus($request)
            ]);

        }catch(Exception $ex)
        {   
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }

    }

    public static function setEditarVaga($request,$id,$id_vaga)
    {
        $postVars = $request->getPostVars(); 
        $vagaModel = new Vaga();

        $vaga = $vagaModel->load($id);
        if(!($vaga instanceof Vaga)){
            throw new Exception("PAGINA NAO ENCONTRADA",404);
        }

        if( empty($postVars['titulo']) || empty($postVars['cidade']) 
            || empty($postVars['fim']) 
            || empty($postVars['descricao'] ) ||  empty($postVars['habilidades'] )   
        ){
            return View::render("vagas::edit",[
                "vaga" => $vaga,
                'status' => Alert::getError("Preencha os campos obrigatórios"),
                
            ]);
        }

        $titulo =   filter_var($postVars['titulo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade =   filter_var($postVars['cidade'],FILTER_SANITIZE_SPECIAL_CHARS);
        $anos =   filter_var($postVars['anos'],FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao =   filter_var($postVars['descricao'],FILTER_SANITIZE_SPECIAL_CHARS);
        $habilidades =   filter_var($postVars['habilidades'],FILTER_SANITIZE_SPECIAL_CHARS);
        $fim=   filter_var($postVars['fim'],FILTER_SANITIZE_SPECIAL_CHARS);
        $area=   filter_var($postVars['area'],FILTER_SANITIZE_SPECIAL_CHARS);
        $formato =  filter_var($postVars['formato'],FILTER_SANITIZE_EMAIL);
        $modalidade = filter_var($postVars['modalidade'],FILTER_SANITIZE_SPECIAL_CHARS);
        $salario_min= filter_var($postVars['salario_min'],FILTER_SANITIZE_SPECIAL_CHARS);
        $salario_max =  doubleval(filter_var($postVars['salario_max'],FILTER_SANITIZE_SPECIAL_CHARS));
        $id_empresa = $postVars['id_empresa'];
        $nivel = filter_var($postVars['nivel'],FILTER_SANITIZE_EMAIL);
        $estado = $postVars['estado'];

        
        $vaga->setTitulo($titulo);
        $vaga->setCidade($cidade);
        $vaga->setAnos($anos);
        $vaga->setDescricao($descricao);
        $vaga->setHabilidades($habilidades);
        $vaga->setLimite($fim);
        $vaga->setFormato($formato);
        $vaga->setModalidade($modalidade);
        $vaga->setSalarioMin($salario_min);
        $vaga->setSalarioMax($salario_max);
        $vaga->setIdEmpresa($id_empresa);
        $vaga->setArea($area);
        $vaga->setEducacao($nivel);
        $vaga->setEstado($estado);
        
        try{
            if(($vaga->update())){
                $request->getRouter()->redirect("/empresas/{$id}/vagas/{$id_vaga}/editar?status=updated");
            }else{
                $request->getRouter()->redirect("/empresas/{$id}/vagas/{$id_vaga}/editar?status=error");
            }

        }catch(Exception $ex)
        {   echo "<pre>";
            print_r($ex->getMessage());
            echo "</pre>";
            exit;
            $request->getRouter()->redirect("/empresas/{$id}/vagas/{$id_vaga}/editar?status=error");
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