<?php
namespace App\Models;

use App\Utils\Conexao;

class Vaga{

    private $id;
    private $titulo;
    private $formato;
    private $modalidade;
    private $salario_min;
    private $salario_max;
    private $descricao;
    private $habilidades;
    private $anos_de_experiencia;
    private $educacao;
    private $data_limite;
    private $estado;
    private $cidade;
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setFormato($formato)
    {   $this->formato = $formato; }
    public function setCidade($city)
    {
        $this->cidade = $city;
    }
    public function setDescricao($desc)
    {
        $this->descricao = $desc;
    }
    public function setEducacao($educacao)
    {
        $this->educacao = $educacao;
    }
    public function setLimite($limit)
    {
        $this->data_limite = $limit;
    }
    public function setHabilidades($skills)
    {
        $this->habilidades = $skills;
    }


    public function setEstado($status)
    {
        $this->estado = $status;
    }

    public function setAnos($anos)
    {
        $this->anos_de_experiencia = $anos;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAnos()
    {
        return $this->anos_de_experiencia;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function getCidade()
    {
        return $this->cidade;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getFormato()
    {
        return $this->formato;
    }
    public function getModalidade()
    {
        return $this->modalidade;
    }
    public function getSalarioMin()
    {
        return $this->salario_min;
    }
    public function getSalarioMax()
    {
        return $this->salario_max;
    }
    public function getHabilidades()
    {
        return $this->habilidades;
    }

    public function getEducacao()
    {
        return $this->educacao;
    }
    
    public function getDataLimite()
    {
        return $this->data_limite;
    }


    public function getEstado()
    {
        return $this->estado;
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
        $query = "INSERT INTO vaga (:nome,:email,:senha) VALUES ()";

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