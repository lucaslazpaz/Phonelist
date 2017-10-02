<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json,text/html;charset=utf-8');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

require __DIR__ . DIRECTORY_SEPARATOR .'Framework' . DIRECTORY_SEPARATOR . 'App.class.php';

use Framework\App;
use Framework\Common\Conexao;

try{
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Db.ini';
    Conexao::setFileIni($file);
    $app = new App();
    $app->start();
}catch (\Exception $e){
    header('HTTP/1.1 ' . $e->getCode());
    echo json_encode(['message'=>$e->getMessage()]);
}