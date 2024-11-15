<?php

namespace core;

class App
{

    public static $app;

    public function __construct()
    {
       $query = trim(urldecode($_SERVER['REQUEST_URI']),'/');//QUERY_STRING - всё что идёт после ? REQUEST_URI - полный путь без домена

        new ErrorHandler();
        session_start();
        self::$app = Registry::getInstance();
        $this->getParams();

        Router::dispatch($query);
    }

    protected function getParams(){
        $params = require_once CONFIG . '/params.php';

        if(!empty($params)){
            foreach ($params as $k=>$v){
                self::$app->setProperty($k,$v);
            }

        }
    }


}