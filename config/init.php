<?php

define("DEBUG",1);
define("ROOT",dirname(__DIR__));
define("WWW",ROOT . '/public');
define("APP",ROOT . '/app');
define("CORE",ROOT .'/vendor/core');
define("HELPERS",ROOT . '/vendor/core/heplers');
define("CACHE",ROOT . '/tmp/cache');
define("LOGS",ROOT.'/tmp/logs');
define("CONFIG",ROOT . '/config');
define("LAYOUT",'wine');
define("PATH",'http://127.0.0.1:8881');
define("ADMIN",'http://127.0.0.1:8881/admin');
define("NO-IMAGE",'uploads/no_image.jpg');

require_once ROOT . '/vendor/autoload.php';

?>