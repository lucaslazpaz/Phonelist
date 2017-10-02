<?php

namespace Framework\Common;

use Framework\Common\Conexao;

abstract class Model{

    public function getClass(){
        return new \ReflectionClass($this);
    }

    protected function getTbName(){
        $str = \str_replace($this->getClass()->getNamespaceName() . '\\','', $this->getClass()->getName());
        return \strtolower($str);
    }

    protected function getPropiers(){
        $props=$this->getClass()->getProperties();
        $count=count($props);
        $array=[];
        for($i = 0; $i < $count; $i++){
            $array[]=$props[$i]->name;
        }
        return $array;
    }

    protected function getPropiersWithValues(){
        $props=$this->getPropiers();
        $count=count($props);
        $array=[];
        for($i=0;$i<$count;$i++){
            $array[$props[$i]]=$this->{$props[$i]};
        }
        return $array;
    }

    protected function query($sql, $obj=null){
        $conexao = new Conexao();
        $executar=$conexao->prepare($sql);
        $executar->execute($obj);
       // $this->id=$conexao->lastInsertId();
        return $executar;
    }

    protected function fieldQuery(){
        $sql="SHOW FIELDS FROM ".$this->getTbName();
        return $this->query($sql)->fetchAll(\PDO::FETCH_ASSOC);//SÓ TRAS OS NOMES

    }

    public function listar(){
        $sql="select * from ".$this->getTbName();
        $lista=$this->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $lista;
    }

    public function inserir(){
        //$this->$className=$this;
        $sql='insert into '.$this->getTbName().' ('.\implode(',',$this->getPropiers()).') values (:'.\implode(',:',$this->getPropiers()).') ';
        return $this->query($sql,$this->getPropiersWithValues());
    }

    public function editar(){
        //$this->$className=$this;
        $sql='Update ' . $this->getTbName() . ' set ';
        $array=$this->getPropiers();
        $count=count($array);
        for($i=0; $i<$count; $i++){
            $sql.=$array[$i].'=:'.$array[$i];
            if($i!=$count-1)
                $sql.=',';
        }
        $sql.=' where id=:id';
        $this->query($sql,$this->getPropiersWithValues());
    }

    public function delete(){
        //$this->$className=$this;
        $sql='Delete from '.$this->getTbName().' where id=:id';
        $this->query(['id'=>$this->id]);
    }

    public function pesquisar($pesq){
        //$this->$className=$this;
        $sql="select * from ".$this->getTbName()." where ".$pesq."=:".$pesq;
        $result=$this->query($sql,[$pesq=>$this->email]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}