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
        $stmt->bindParam(":nome",$this->getNome());
        $stmt->bindParam(":email",$this->getEmail());
        $stmt->bindParam(":senha",$this->getSenha());
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
            echo "<pre>";
print_r($stmt->rowCount());
echo "</pre>";
exit;
            return false;
        }
    }

    public function getFormacoes($id)
    {
        $query = "SELECT * FROM formacao WHERE id_user =:id_user";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_user",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
        }       
    }

    public function getCursos($id)
    {
        $query = "SELECT * FROM curso WHERE id_user =:id_user";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_user",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
        }       
    }

    public function getExperiencias($id)
    {
        $query = "SELECT * FROM experiencia WHERE id_user =:id_user";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_user",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
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

}