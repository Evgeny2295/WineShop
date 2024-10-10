<?php

namespace core;

class ErrorHandler
{

    public function __construct(){

        //https://habr.com/ru/post/161483/
        if(DEBUG){
            error_reporting(-1); //Включаем показ ошибок
        }else{
            error_reporting(0); //Отключаем показ ошибок
        }

        set_exception_handler([$this,'exceptionHandler']);//Задаёт пользовательский обработчик исключений.Задаёт обработчик по умолчанию для случаев, когда исключение выброшено вне блока try/catch. После вызова callback выполнение будет остановлено.
        set_error_handler([$this,'errorHandler']);//задаёт пользовательский обработчик ошибок
        ob_start();

        register_shutdown_function([$this,'fatalErrorHandler']);//Регистрирует функцию, которая выполнится при завершении работы скрипта

    }

    public function errorHandler($errno,$errstr,$errfile,$errline){
        $this->logError($errstr,$errfile,$errline);
        $this->displayError($errno,$errstr,$errfile,$errline);
    }

    public function fatalErrorHandler(){

        $error = error_get_last();//Получает последнюю ошибку

        if(!empty(($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))){
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError($error['type'],$error['message'],$error['file'],$error['line']);
        }else{
            ob_end_flush();//Функция вызывает обработчик вывода (с флагом PHP_OUTPUT_HANDLER_FINAL), сбрасывает (отправляет) возвращённое им значение, удаляет содержимое активного буфера вывода и отключает активный буфер вывода.
        }
    }

    public function exceptionHandler(\Throwable $e){


        $this->logError($e->getMessage(),$e->getFile(),$e->getLine());
        $this->displayError('Исключение',$e->getMessage(),$e->getFile(),$e->getLine(),$e->getCode());

    }
    protected function logError($message = '',$file = '', $line = ''){
        file_put_contents(
            LOGS . '/errors.log',
            "[" . date('Y-m-d H:i:s') . "] 
            Текст ошибки: {$message} | Файл: {$file} | Строка:{$line}\n========\n",
            FILE_APPEND
        );
    }
    protected function displayError($errno,$errstr,$errfile,$errline,$response = 500){

        if($response == 0){
            $response = 404;
        }

        http_response_code((int)$response);

        if($response == 404 && !DEBUG){

            require WWW . '/errors/404.php';
            die;
        }
        if(DEBUG){
            require WWW . '/errors/development.php';
        }else{
            require WWW . '/errors/production.php';
        }

        die;
    }
}