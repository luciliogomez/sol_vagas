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
        habilidades,cv,estado,foto,telefone,area,ingles FROM candidato";

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
        habilidades,cv,estado,foto,telefone,area,ingles FROM candidato WHERE id =:id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam("id",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchObject(Candidato::class);
        
        }else{

            return [];
        
        }
    }


    public function create()
    {
        $query = "INSERT INTO candidato (:nome,:email,:senha) VALUES ()";

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
        $query = "UPDATE candidato SET nome = :nome, email = :email, cidade = :cidade, titulo = :titulo,resumo = :resumo,
        habilidades = :habilidades, cv = :cv, estado = :estado,foto = :foto, telefone = :telefone, area = :area, ingles = :ingles WHERE id = :id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->getNome());
        $stmt->bindParam(":email",$this->getEmail());
        $stmt->bindParam(":cidade",$this->getCidade());
        $stmt->bindParam(":foto",$this->getFoto());
        $stmt->bindParam(":resumo",$this->getResumo());
        $stmt->bindParam(":titulo",$this->getTitulo());
        $stmt->bindParam(":habilidades",$this->getHabilidades());
        $stmt->bindParam(":cv",$this->getCv());
        $stmt->bindParam(":area",$this->getArea());
        $stmt->bindParam(":estado",$this->getEstado());
        $stmt->bindParam(":telefone",$this->getTelefone());
        $stmt->bindParam(":ingles",$this->getNivelIngles());
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return true;
        
        }else{
            return false;
        }
    }

}