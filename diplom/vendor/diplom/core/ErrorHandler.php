<?php


namespace diplom;


class ErrorHandler
{
public function __construct()
{
    if(DEBUG){
        error_reporting(-1);
    } else {
        error_reporting(0);
    }
    set_exception_handler([$this, 'exeptionHandler']);

}

public function exeptionHandler($e){
$this -> logErrors($e-> getMessage(), $e->getFile(), $e->getLine());
$this -> displayError('Исключение',$e-> getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
}

protected function logErrors($message = '', $file ='', $line=''){
 error_log("[".date('Y-m-d H:i:s')."] 
 Текст ошибки: {$message} | Файл ошибки: {$file} | Строка: {$line}\n++++++++\n", 3, ROOT . '/tmp/errors.log');
}

protected function displayError($errno, $errstr, $errfile, $errline, $response = 404){

    http_response_code($response);
    if($response===404 && !DEBUG){
    require WWW . '/errors/404.php';
    die;
    }
    elseif (DEBUG){
        require WWW . '/errors/dev.php';

    }
    else {
        require WWW . '/errors/prod.php';
    }
    die;
}
}