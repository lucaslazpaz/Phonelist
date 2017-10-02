<?php

namespace Model;

use Framework\App;
use Framework\Common\Model;

class Pessoa extends Model{
    private $id;
    private $nome;
    private $email;
    private $dataNascimento;
    private $senha;

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }

    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }

    public function setDataNascimento($data){
        $this->dataNascimento = $data;
    }
    public function getDataNascimento(){
        return $this->dataNascimento;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getSenha(){
        return $this->senha;
    }
}