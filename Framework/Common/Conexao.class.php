<?php

namespace Framework\Common;

class Conexao extends \PDO{

    private static $file_ini = null;

     public static function setFileIni($file){
          self::$file_ini = $file;
     }
     public function __construct(){
         if(is_null(self::$file_ini))
             throw new \Exception('Arquivo de conexão não informado');
         $config = \parse_ini_file(self::$file_ini);
         parent::__construct("mysql:dbname=".$config["DATABASE"].";host=".$config["HOST"],$config["USER"],$config["PASSWORD"]);
     }
}