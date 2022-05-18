<?php
namespace App\Models;

use App\Utils\Conexao;

class Vaga{

    private $id;
    private $titulo;
    private $formato;
    private $area;
    private $modalidade;
    private $salario_min;
    private $salario_max;
    private $descricao;
    private $habilidades;
    private $ano_de_experiencia;
    private $educacao;
    private $data_limite;
    private $estado;
    private $cidade;
    private $id_empresa;
    private $empresa;
    private $logotipo;

    

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

    public function setArea($area)
    {
        $this->area = $area;
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

    public function setModalidade($modalidade)
    {
        $this->modalidade = $modalidade;
    }
    public function setSalarioMin($salario_min)
    {
        $this->salario_min = (isset($salario_min)?$salario_min:0);
    }

    public function setSalarioMax($salario_max)
    {
        $this->salario_max = (isset($salario_max)?$salario_max:0);;
    }

    public function setEstado($status)
    {
        $this->estado = $status;
    }

    public function setAnos($anos)
    {
        $this->ano_de_experiencia = $anos;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAnos()
    {
        return $this->ano_de_experiencia;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function getLogotipo()
    {
        return $this->logotipo;
    }
    public function getArea()
    {
        return $this->area;
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
    public function getEmpresa()
    {
        return $this->empresa;
    }


    public function read($limit = null)
    {
        $limit = (strlen($limit))? "limit ".$limit:"";

        $query = "SELECT V.id,V.titulo,V.formato,V.modalidade,V.area,V.cidade,V.salario_min,V.salario_max,
        V.descricao,V.habilidades,V.ano_de_experiencia,V.educacao,V.data_limite,V.estado,V.id_empresa,E.nome as empresa FROM `vaga` V
        INNER JOIN empresa E ON (V.id_empresa = E.id) ORDER BY id DESC ".$limit;

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
        $query = "SELECT V.id,V.titulo,V.formato,V.modalidade,V.area,V.cidade,V.salario_min,V.salario_max,
        V.descricao,V.habilidades,V.ano_de_experiencia,V.educacao,V.data_limite,V.estado,V.id_empresa,E.nome as empresa, E.logotipo FROM `vaga` V
        INNER JOIN empresa E ON (V.id_empresa = E.id) WHERE V.id = :id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam("id",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchObject(Vaga::class);
        
        }else{

            return [];
        
        }
    }


    public function search($search,$area,$modalidade,$formato,$cidade,$limit = null)
    {
        $limit = (strlen($limit))? "limit ".$limit:"";
        $search     = "%".$search."%";
        $area       = $area."%";
        $modalidade = $modalidade."%";
        $formato    = $formato."%";
        $cidade     = "%".$cidade."%";

        
        $query = "SELECT V.id,V.titulo,V.formato,V.modalidade,V.cidade,V.salario_min,V.salario_max,
        V.descricao,V.habilidades,V.ano_de_experiencia,V.educacao,V.data_limite,V.estado,V.id_empresa,E.nome as empresa,E.logotipo FROM `vaga` V
        INNER JOIN empresa E ON (V.id_empresa = E.id) 
        WHERE V.titulo like :search
        AND V.area like :area
        AND V.formato like :formato
        AND V.modalidade like :modalidade
        AND V.cidade like :cidade
        ORDER BY id DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":search",$search);
        $stmt->bindParam(":area",$area);
        $stmt->bindParam(":modalidade",$modalidade);
        $stmt->bindParam(":formato",$formato);
        $stmt->bindParam(":cidade",$cidade);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_CLASS,Vaga::class);
        
        }else{
            return [];
        }
    }

    public function create()
    {
        $query = "INSERT INTO vaga 
        (
            titulo,
            area,
            formato,
            modalidade,
            cidade,
            salario_min,
            salario_max,
            descricao,
            habilidades,
            ano_de_experiencia,
            educacao,
            data_limite,
            estado,
            id_empresa
        ) 
        VALUES 
        (
            :titulo,
            :area,
            :formato,
            :modalidade,
            :cidade,
            :salario_min,
            :salario_max,
            :descricao,
            :habilidades,
            :anos_de_experiencia,
            :educacao,
            :data_limite,
            1,
            :id_empresa
        )";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":titulo",$this->titulo);
        $stmt->bindParam(":formato",$this->formato);
        $stmt->bindParam(":modalidade",$this->modalidade);
        $stmt->bindParam(":cidade",$this->cidade);
        $stmt->bindParam(":salario_min",$this->salario_min);
        $stmt->bindParam(":salario_max",$this->salario_max);
        $stmt->bindParam(":descricao",$this->descricao);
        $stmt->bindParam(":habilidades",$this->habilidades);
        $stmt->bindParam(":anos_de_experiencia",$this->ano_de_experiencia);
        $stmt->bindParam(":educacao",$this->educacao);
        $stmt->bindParam(":data_limite",$this->data_limite);
        $stmt->bindParam(":id_empresa",$this->id_empresa);
        $stmt->bindParam(":area",$this->area);
        
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return Conexao::getInstance()->lastInsertId();
        
        }else{
            return null;
        }
    }

    public function update()
    {
        $query = "UPDATE vaga SET titulo = :titulo,area=:area,formato = :formato,
        modalidade = :modalidade,cidade = :cidade,salario_min = :salario_min,
        salario_max = :salario_max,descricao = :descricao,habilidades = :habilidades,
        ano_de_experiencia = :anos_de_experiencia,educacao = :educacao,
        data_limite = :data_limite,estado = :estado,id_empresa = :id_empresa 
        WHERE id = :id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":titulo",$this->titulo);
        $stmt->bindParam(":formato",$this->formato);
        $stmt->bindParam(":modalidade",$this->modalidade);
        $stmt->bindParam(":cidade",$this->cidade);
        $stmt->bindParam(":area",$this->area);
        $stmt->bindParam(":salario_min",$this->salario_min);
        $stmt->bindParam(":salario_max",$this->salario_max);
        $stmt->bindParam(":descricao",$this->descricao);
        $stmt->bindParam(":habilidades",$this->habilidades);
        $stmt->bindParam(":anos_de_experiencia",$this->ano_de_experiencia);
        $stmt->bindParam(":educacao",$this->educacao);
        $stmt->bindParam(":data_limite",$this->data_limite);
        $stmt->bindParam(":estado",$this->estado);
        $stmt->bindParam(":id_empresa",$this->id_empresa);
        $stmt->bindParam(":id",$this->id);
        
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return true;
        
        }else{
            return false;
        }
    }

    public function isCandidato($id_candidato,$id_vaga,$limit = null)
    {
        $query = "  SELECT * FROM candidatura 
                    WHERE id_candidato =:candidato 
                    AND id_vaga = :vaga ;";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":candidato",$id_candidato);
        $stmt->bindParam(":vaga",$id_vaga);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }       
    }

    public function aplicarVaga($id_candidato,$id_vaga,$limit = null)
    {
        $query = "  INSERT INTO candidatura (id_candidato,id_vaga,estado) 
                    VALUES(:candidato,:vaga,'pendente');";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":candidato",$id_candidato);
        $stmt->bindParam(":vaga",$id_vaga);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }       
    }

}