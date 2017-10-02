<?php

namespace Model;

use Framework\Common\Model;

class Telefone extends Model {
    private $id;
    private $Pessoa;
    private $numero;

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }

    public function setNumero($numero){
        $this->$numero = $numero;
    }
    public function getNumero(){
        return $this->numero;
    }

    public function setPessoa(Pessoa $pessoa){
        $this->Pessoa = $pessoa;
    }
    public function getPessoa(){
        return $this->Pessoa;
    }
}