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
    private $id_empresa;

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

    public function setIdEmpresa($id)
    {
        $this->id_empresa = $id;
    }
    public function getIdEmpresa()
    {
        return $this->id_empresa;
    }


    public function read()
    {
        $query = "SELECT * FROM vaga";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_CLASS,Vaga::class);
        
        }else{

            return [];
        
        }
    }
    public function load($id)
    {
        $query = "SELECT id,titulo,formato,modalidade,cidade,salario_min,salario_max,
        descricao,habilidades,anos_de_experiencia,educacao,data_limite,estado,id_empresa 
        FROM vaga WHERE id =:id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam("id",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchObject(Vaga::class);
        
        }else{

            return [];
        
        }
    }


    public function create()
    {
        $query = "INSERT INTO vaga (titulo,formato,modalidade,cidade,salario_min,salario_max,
        descricao,habilidades,anos_de_experiencia,educacao,data_limite,estado,id_empresa) 
        VALUES (:titulo,:formato,:modalidade,:cidade,:salario_min,:salario_max,
        :descricao,:habilidades,:anos_de_experiencia,:educacao,:data_limite,:estado,:id_empresa)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":titulo",$this->getTitulo());
        $stmt->bindParam(":formato",$this->getFormato());
        $stmt->bindParam(":modalidade",$this->getModalidade());
        $stmt->bindParam(":cidade",$this->getCidade());
        $stmt->bindParam(":salario_min",$this->getSalarioMin());
        $stmt->bindParam(":salario_max",$this->getSalarioMax());
        $stmt->bindParam(":descricao",$this->getDescricao());
        $stmt->bindParam(":habilidades",$this->getHabilidades());
        $stmt->bindParam(":anos_de_experiencia",$this->getAnos());
        $stmt->bindParam(":educacao",$this->getEducacao());
        $stmt->bindParam(":data_limite",$this->getDataLimite());
        $stmt->bindParam(":estado",$this->getEstado());
        $stmt->bindParam(":id_empresa",$this->getIdEmpresa());
        
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return Conexao::getInstance()->lastInsertId();
        
        }else{
            return null;
        }
    }

    public function update()
    {
        $query = "UPDATE vaga SET titulo = :titulo,formato = :formato,
        modalidade = :modalidade,cidade = :cidade,salario_min = :salario_min,
        salario_max = :salario_max,descricao = :descricao,habilidades = :habilidades,
        anos_de_experiencia = :anos_de_experiencia,educacao = :educacao,
        data_limite = :data_limite,estado = :estado,id_empresa = :id_empresa 
        WHERE id = :id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":titulo",$this->getTitulo());
        $stmt->bindParam(":formato",$this->getFormato());
        $stmt->bindParam(":modalidade",$this->getModalidade());
        $stmt->bindParam(":cidade",$this->getCidade());
        $stmt->bindParam(":salario_min",$this->getSalarioMin());
        $stmt->bindParam(":salario_max",$this->getSalarioMax());
        $stmt->bindParam(":descricao",$this->getDescricao());
        $stmt->bindParam(":habilidades",$this->getHabilidades());
        $stmt->bindParam(":anos_de_experiencia",$this->getAnos());
        $stmt->bindParam(":educacao",$this->getEducacao());
        $stmt->bindParam(":data_limite",$this->getDataLimite());
        $stmt->bindParam(":estado",$this->getEstado());
        $stmt->bindParam(":id_empresa",$this->getIdEmpresa());
        $stmt->bindParam(":id",$this->getId());
        
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return true;
        
        }else{
            return false;
        }
    }

}