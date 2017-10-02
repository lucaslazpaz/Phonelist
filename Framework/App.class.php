<?php

namespace Framework;

spl_autoload_register(function($class_name){

   $arquivo =  __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .
       \str_replace(['\\','/'], DIRECTORY_SEPARATOR, $class_name) . ".class.php";
   if(!file_exists($arquivo))
       throw new \Exception('Erro, n�o achou o arquivo ' . $arquivo);
   require $arquivo;
});

class App{
    public function start(){
        $x = \explode('/', $_SERVER['PATH_INFO']);
        $nomeController = 'Controller\\' . $x[1];
        $controller = new $nomeController;
        if(!method_exists($controller, $x[2]))
            throw new \Exception('Erro, n�o achou o m�todo');
        $controller->{$x[2]}();
    }
}