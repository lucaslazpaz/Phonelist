<?php

namespace Controller;

use Model\Pessoa as pessoaModel;
use Framework\Common\Conexao;

class Pessoa extends pessoaModel{

    public function select(){
        $sql = "select * from Pessoa";
        $conexao = new Conexao();
        $executar=$conexao->prepare($sql);
        $executar->execute();
        $result =  $executar->fetchAll(\PDO::FETCH_ASSOC);
        print_r($result);
    }

    public function insert(){
        $obj = new Pessoa();
        $con = new Conexao();
        $obj->setEmail('p9965p@gmail.com');
        $obj->setNome('Lucas');
        $obj->setSenha('123466');
        $sql = "insert into Pessoa (nome,email,senha) values (:Nome,:Email,:Senha)";
        $valores = array('Nome'=>$obj->getNome(),'Email'=>$obj->getEmail(),'Senha'=>$obj->getSenha());
        $executar = $con->prepare($sql);
        $executar->execute($valores);
        $lastId = $con->lastInsertId();
        echo $lastId;
    }

    public function Login(){

        $post = \json_decode($_POST['myData']);
        $obj = new pessoaModel();
        $obj->setSenha($post->senha);
        $obj->setEmail($post->email);

        $conexao = new Conexao();
        $sql = "select * from pessoa where email = :email and senha = :senha";
        $executar = $conexao->prepare($sql);
        $executar->execute(array('email'=>$obj->getEmail(),'senha'=>$obj->getSenha()));
        $result = $executar->fetchAll(\PDO::FETCH_ASSOC);
        if(count($result)==0)
            throw new \Exception('Usuário não encontrado',412);
    }

    public function Cadastrar(){
        $post = \json_decode($_POST['myData']);
        $obj = new pessoaModel();
        $obj->setNome($post->nome);
        $obj->setEmail($post->email);
        $obj->setSenha($post->senha);

        $conexao = new Conexao();
        $sql = "select * from pessoa where email = :email";
        $executar = $conexao->prepare($sql);
        $executar->execute(array('email'=>$obj->getEmail()));
        $result = $executar->fetchAll(\PDO::FETCH_ASSOC);
        if(count($result)!=0)
            throw new \Exception('E-mail já cadastrado',412);
        $sql2 = "insert into pessoa (nome,email,senha) VALUES (:nome, :email, :senha)";
        $executar2 = $conexao->prepare($sql2);
        $executar2->execute(array('nome'=>$obj->getNome(),'email'=>$obj->getEmail(), 'senha'=>$obj->getSenha()));
        $lastid = $conexao->lastInsertId();
    }

}