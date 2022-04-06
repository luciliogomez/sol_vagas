<?php
namespace App\Models;

class User{
    private $id;

    private $nome;

    private $email;

    private $senha;

    private $nivel;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }
    public function getNivel()
    {
        return $this->nivel;
    }

}