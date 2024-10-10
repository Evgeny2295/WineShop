<?php

if(PHP_MAJOR_VERSION < 8){
    echo 'Необходима версия PHP >= 8';
}

require_once dirname(__DIR__) . '/config/init.php';
require_once dirname(__DIR__) . '/vendor/core/helpers/functions.php';

require_once CONFIG . '/routes.php';

new core\App();


//throw new Exception('Возникла ошибка',404);

