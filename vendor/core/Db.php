<?php

namespace core;



class Db
{
    public object $conn;
    use TSingleton;

    private function __construct(){
        $db = require_once CONFIG . '/config_db.php';

        $this->conn = new \PDO("mysql:host=wine_db;dbname=wine", $db['user_name'], $db['password'],$db['opt']);

}



}