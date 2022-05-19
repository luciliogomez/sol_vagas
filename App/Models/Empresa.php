<?php
namespace App\Models;
use App\Utils\Conexao;

class Empresa{

    private $id;

    private $nome;

    private $email;

    private $ano;

    private $descricao;

    private $cidade;

    private $telefone;

    private $logotipo;

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
    public function setLogo($pic)
    {
        $this->logotipo = $pic;
    }
    public function setTelefone($phone)
    {
        $this->telefone = $phone;
    }
    public function setDescricao($resume)
    {
        $this->descricao = $resume;
    }

    public function setAnoFundacao($year)
    {
        $this->ano = $year;
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
    public function getLogo()
    {
        return $this->logotipo;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    
    public function getAnoFundacao()
    {
        return $this->ano;
    }

    public function getSenha()
    {
        return $this->senha;
    }


    public function read()
    {
        $query = "SELECT id,nome,email,cidade,descricao,
        logotipo,telefone,ano FROM empresa";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_CLASS,Empresa::class);
        }else{
            return [];
        }
    }

    public function load($id)
    {
        $query = "SELECT id,nome,email,cidade,descricao,
        logotipo,telefone,ano FROM empresa 
        WHERE id = :id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchObject(Empresa::class);
        }else{
            return null;
        }
    }

    public function loadByEmail($email)
    {
        $query = "SELECT id,nome,email,cidade,descricao,
        logotipo,telefone,ano,senha FROM empresa 
        WHERE email = :email";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchObject(Empresa::class);
        }else{
            return null;
        }
    }


    public function create()
    {
        $query = "INSERT INTO empresa (nome,email,senha) 
        VALUES (:nome,:email,:senha)";

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
        $query = "UPDATE empresa SET nome = :nome, email = :email, cidade = :cidade,
        logotipo = :foto, telefone = :telefone, ano = :ano,descricao = :descricao 
        WHERE id = :id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->nome);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":cidade",$this->cidade);
        $stmt->bindParam(":foto",$this->logotipo);
        $stmt->bindParam(":telefone",$this->telefone);
        $stmt->bindParam(":ano",$this->ano);
        $stmt->bindParam(":descricao",$this->descricao);
        $stmt->bindParam(":cidade",$this->cidade);
        $stmt->bindParam(":id",$this->id);
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
                    CAND.id, CAND.id_candidato, CAND.estado, VA.id AS id_vaga,CA.nome,
                    VA.titulo, VA.data_limite, EMP.id AS id_empresa, EMP.logotipo
                    FROM candidatura CAND INNER JOIN vaga VA ON(CAND.id_vaga = VA.id)
                    INNER JOIN empresa EMP ON(VA.id_empresa = EMP.id)
                    INNER JOIN candidato CA ON(CAND.id_candidato = CA.id)
                    WHERE EMP.id = :id ORDER BY CAND.id DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return ($stmt->fetchAll(\PDO::FETCH_ASSOC));
        }else{
            return [];
        }       
    }

    public function getCandidaturaOne($id_candidatura,$limit = null)
    {
        $limit = (strlen($limit))? " limit ".$limit:"";
        $query = "  SELECT 
                    CAND.id, CAND.id_candidato, CAND.estado, VA.id AS id_vaga,CA.nome,
                    VA.titulo, VA.data_limite, EMP.id AS id_empresa, EMP.logotipo
                    FROM candidatura CAND INNER JOIN vaga VA ON(CAND.id_vaga = VA.id)
                    INNER JOIN empresa EMP ON(VA.id_empresa = EMP.id)
                    INNER JOIN candidato CA ON(CAND.id_candidato = CA.id)
                    WHERE CAND.id = :id ORDER BY CAND.id DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id_candidatura);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return ($stmt->fetch(\PDO::FETCH_ASSOC));
        }else{
            return null;
        }       
    }

    public function getCandidaturasByVagas($id,$id_vaga, $limit = null)
    {
        $limit = (strlen($limit))? " limit ".$limit:"";
        $query = "  SELECT 
                    CAND.id, CAND.id_candidato, CAND.estado, VA.id AS id_vaga,CA.nome,
                    VA.titulo, VA.data_limite, EMP.id AS id_empresa, EMP.logotipo
                    FROM candidatura CAND INNER JOIN vaga VA ON(CAND.id_vaga = VA.id)
                    INNER JOIN empresa EMP ON(VA.id_empresa = EMP.id)
                    INNER JOIN candidato CA ON(CAND.id_candidato = CA.id)
                    WHERE EMP.id = :id AND VA.id = :id_vaga ORDER BY CAND.id DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":id_vaga",$id_vaga);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return ($stmt->fetchAll(\PDO::FETCH_ASSOC));
        }else{
            return [];
        }       
    }
    public function getVagas($id,$limit = null)
    {
        $limit = (strlen($limit))? " limit ".$limit:"";
        $query = "  SELECT * FROM vaga
                    WHERE id_empresa = :empresa
                    ORDER BY id DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":empresa",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return ($stmt->fetchAll(\PDO::FETCH_ASSOC));
        }else{
            return [];
        }       
    }
    public function getVagasByEstado($id,$estado,$limit = null)
    {
        $limit = (strlen($limit))? " limit ".$limit:"";
        $query = "  SELECT * FROM vaga
                    WHERE id_empresa = :empresa AND estado = :estado
                    ORDER BY id DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":empresa",$id);
        $stmt->bindParam(":estado",$estado);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return ($stmt->fetchAll(\PDO::FETCH_ASSOC));
        }else{
            return [];
        }       
    }
    public function aprovarCandidatura($id)
    {
        $query = "  UPDATE candidatura SET estado = 'aprovado'
                    WHERE id = :id ";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }     
    }

    public function marcarEntrevista($id)
    {
        $query = "  UPDATE candidatura SET estado = 'entrevista'
                    WHERE id = :id ";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }     
    }

}