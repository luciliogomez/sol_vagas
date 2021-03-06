<?php
namespace App\Models;

use App\Utils\Conexao;

class Candidato{

    private $id;

    private $nome;

    private $email;

    private $titulo;

    private $foto;

    private $cidade;

    private $telefone;

    private $resumo;

    private $habilidades;

    private $area;

    private $ingles;

    private $cv;

    private $estado;

    private $senha;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setCidade($city)
    {
        $this->cidade = $city;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setFoto($pic)
    {
        $this->foto = $pic;
    }
    public function setTelefone($phone)
    {
        $this->telefone = $phone;
    }
    public function setResumo($resume)
    {
        $this->resumo = $resume;
    }
    public function setHabilidades($skills)
    {
        $this->habilidades = $skills;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }
    public function setNivelIngles($ingles)
    {
        $this->ingles = $ingles;
    }

    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    public function setEstado($status)
    {
        $this->estado = $status;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getCidade()
    {
        return $this->cidade;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getFoto()
    {
        return $this->foto;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function getResumo()
    {
        return $this->resumo;
    }
    public function getHabilidades()
    {
        return $this->habilidades;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function getCv()
    {
        return $this->cv;
    }

    public function getEstado()
    {
        return $this->estado;
    }
    
    public function getSenha()
    {
        return $this->senha;
    }
    public function getNivelIngles()
    {
        return $this->ingles;
    }


    public function read()
    {
        $query = "SELECT id,nome,email,cidade,titulo,resumo,
        habilidades,cv,estado,foto,telefone,area,ingles 
        FROM candidato";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_CLASS,Candidato::class);
        
        }else{

            return [];
        
        }
    }

    public function load($id)
    {
        $query = "SELECT id,nome,email,cidade,titulo,resumo,
        habilidades,cv,estado,foto,telefone,area,ingles 
        FROM candidato WHERE id =:id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam("id",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchObject(Candidato::class);
        
        }else{

            return null;
        
        }
    }

    public function loadByEmail($email)
    {
        $query = "SELECT id,nome,email,cidade,titulo,resumo,
        habilidades,cv,estado,foto,telefone,area,ingles,senha 
        FROM candidato WHERE email =:email";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchObject(Candidato::class);
        
        }else{

            return null;
        
        }
    }


    public function create()
    {
        $query = "INSERT INTO candidato (nome,email,senha) VALUES (:nome,:email,:senha)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->nome);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":senha",$this->senha);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return Conexao::getInstance()->lastInsertId();
        
        }else{
            return null;
        }
    }

    public function update()
    {
        $query = "UPDATE candidato SET nome = :nome, email = :email, 
        cidade = :cidade, titulo = :titulo, resumo = :resumo,
        habilidades = :habilidades, cv = :cv, estado = :estado,
        foto = :foto, telefone = :telefone, area = :area, ingles = :ingles 
        WHERE id = :id";

        $nome = $this->getNome();
        $email = ($this->getEmail());
        $cidade = $this->getCidade();
        $estado = $this->getEstado();
        $ingles = $this->getNivelIngles();
        $telefone = $this->getTelefone();
        $resumo = $this->getResumo();
        $foto = $this->getFoto();
        $skills = $this->getHabilidades();
        $area = $this->getArea();
        $cv = $this->getCv();
        $titulo = $this->getTitulo();
        $id = $this->getId();
      
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$nome);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":cidade",$cidade);
        $stmt->bindParam(":foto",$foto);
        $stmt->bindParam(":resumo",$resumo);
        $stmt->bindParam(":titulo",$titulo);
        $stmt->bindParam(":habilidades",$skills);
        $stmt->bindParam(":cv",$cv);
        $stmt->bindParam(":area",$area);
        $stmt->bindParam(":estado",$estado);
        $stmt->bindParam(":telefone",$telefone);
        $stmt->bindParam(":ingles",$ingles);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return true;
        
        }else{
            
            return false;
        }
    }

    public function getFormacoes($id,$id_formacao = null)
    {
        $filter_one = isset($id_formacao) ? " AND id = {$id_formacao} ": "";

        $query = "SELECT * FROM formacao WHERE id_user =:id_user ".$filter_one;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_user",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return ( (isset($id_formacao))
                ?($stmt->fetch(\PDO::FETCH_ASSOC) )
                :($stmt->fetchAll(\PDO::FETCH_ASSOC) ) 
            );
        }else{

            return ( (isset($id_formacao))
                ?null
                :[] 
            );
        }       
    }
    
    public function getCursos($id,$id_curso=null)
    {
        $filter_one = isset($id_curso) ? " AND id = {$id_curso} ": "";
        $query = "SELECT * FROM curso WHERE id_user =:id_user " .$filter_one;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_user",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return ( (isset($id_curso))
                ?($stmt->fetch(\PDO::FETCH_ASSOC) )
                :($stmt->fetchAll(\PDO::FETCH_ASSOC) ) 
            );
        
        }else{

            return ( (isset($id_curso))
                ?null
                :[] 
            );
        
        }       
    }

    public function getExperiencias($id,$id_experiencia=null)
    {
        $filter_one = isset($id_experiencia) ? " AND id = {$id_experiencia} ": "";
        $query = "SELECT * FROM experiencia WHERE id_user =:id_user ".$filter_one;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_user",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return ( (isset($id_experiencia))
                ?($stmt->fetch(\PDO::FETCH_ASSOC) )
                :($stmt->fetchAll(\PDO::FETCH_ASSOC) ) 
            );
        
        }else{

            return ( (isset($id_experiencia))
            ?null
            :[] 
        );
        
        }       
    }


    public function addFormacao($nivel,$curso,$escola,$inicio,$fim,$id_user)
    {
        $query = "INSERT INTO formacao (nivel,curso,escola,inicio,fim,id_user) 
        VALUES (:nivel,:curso,:escola,:inicio,:fim,:user)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nivel",$nivel);
        $stmt->bindParam(":curso",$curso);
        $stmt->bindParam(":escola",$escola);
        $stmt->bindParam(":inicio",$inicio);
        $stmt->bindParam(":fim",$fim);
        $stmt->bindParam(":user",$id_user);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }

    public function updateFormacao($nivel,$curso,$escola,$inicio,$fim,$id_formacao)
    {
        $query = "UPDATE formacao SET nivel=:nivel,curso=:curso,escola=:escola,inicio=:inicio,fim=:fim 
        WHERE id=:id_formacao";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nivel",$nivel);
        $stmt->bindParam(":curso",$curso);
        $stmt->bindParam(":escola",$escola);
        $stmt->bindParam(":inicio",$inicio);
        $stmt->bindParam(":fim",$fim);
        $stmt->bindParam(":id_formacao",$id_formacao);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }

    public function deleteFormacao($id_formacao)
    {
        $query = "DELETE FROM formacao WHERE id=:id_formacao";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_formacao",$id_formacao);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }


    public function addCurso($nome,$escola,$certificado,$data,$id_user)
    {
        $query = "INSERT INTO curso (nome,escola,data_conclusao,certificado,id_user) 
        VALUES (:nome,:escola,:data_conclusao,:certificado,:user)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$nome);
        $stmt->bindParam(":escola",$escola);
        $stmt->bindParam(":data_conclusao",$data);
        $stmt->bindParam(":certificado",$certificado);
        $stmt->bindParam(":user",$id_user);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }

    public function updateCurso($nome,$escola,$certificado,$data,$id_curso)
    {
        $query = "UPDATE curso SET nome=:nome,certificado=:certificado,escola=:escola,data_conclusao=:data_conclusao 
        WHERE id=:id_curso";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$nome);
        $stmt->bindParam(":escola",$escola);
        $stmt->bindParam(":data_conclusao",$data);
        $stmt->bindParam(":certificado",$certificado);
        $stmt->bindParam(":id_curso",$id_curso);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }

    public function deleteCurso($id_curso)
    {
        $query = "DELETE FROM curso WHERE id=:id_curso";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_curso",$id_curso);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }

    public function addExperiencia($cargo,$empresa,$descricao,$inicio,$fim,$id_user)
    {
        $query = "INSERT INTO experiencia (cargo,empresa,inicio,fim,descricao,id_user) 
        VALUES (:cargo,:empresa,:inicio,:fim,:descricao,:user)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":cargo",$cargo);
        $stmt->bindParam(":empresa",$empresa);
        $stmt->bindParam(":inicio",$inicio);
        $stmt->bindParam(":fim",$fim);
        $stmt->bindParam(":descricao",$descricao);
        $stmt->bindParam(":user",$id_user);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }

    public function updateExperiencia($cargo,$empresa,$descricao,$inicio,$fim,$id_experiencia)
    {
        $query = "UPDATE experiencia SET cargo=:cargo,empresa=:empresa,descricao=:descricao,inicio=:inicio,fim=:fim 
        WHERE id=:id_experiencia";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":cargo",$cargo);
        $stmt->bindParam(":empresa",$empresa);
        $stmt->bindParam(":descricao",$descricao);
        $stmt->bindParam(":inicio",$inicio);
        $stmt->bindParam(":fim",$fim);
        $stmt->bindParam(":id_experiencia",$id_experiencia);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }

    public function deleteExperiencia($id_experiencia)
    {
        $query = "DELETE FROM experiencia WHERE id=:id_experiencia";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_experiencia",$id_experiencia);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }


    public function getCandidaturas($id,$limit = null)
    {
        $limit = (strlen($limit))? " limit ".$limit:"";
        $query = "  SELECT 
                    CAND.id, CAND.id_candidato,CAND.estado,VA.id as id_vaga,VA.titulo,VA.data_limite,VA.estado as vaga_estado,
                    EMP.id,EMP.nome,EMP.logotipo
                    FROM candidatura CAND inner join vaga VA ON(CAND.id_vaga=VA.id)
                    inner join empresa EMP ON(VA.id_empresa = EMP.id)
                    WHERE CAND.id_candidato =:id_candidato  ORDER BY CAND.id DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_candidato",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return ($stmt->fetchAll(\PDO::FETCH_ASSOC));
        }else{
            return [];
        }       
    }

}