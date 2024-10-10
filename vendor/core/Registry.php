<?php

namespace core;

class Registry
{

    use TSingleton;

    protected static array $properties = [];

    public function setProperty($name,$value){
        self::$properties[$name] = $value;
    }

    public function getProperty($name){
        return self::$properties[$name] ?? '';
    }

    public function getProperties(){
        return self::$properties;
    }
}