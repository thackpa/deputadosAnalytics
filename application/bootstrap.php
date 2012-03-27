<?php
defined('APPLICATION_PATH') || define('APPLICATION_PATH', __DIR__);

require_once __DIR__ . '/../vendor/silex.phar';
require_once __DIR__ . '/../vendor/goutte.phar';
$vendor = require_once __DIR__.'/../vendor/.composer/autoload_namespaces.php';
$configFile = APPLICATION_PATH."/../config/config.ini";

$app = new Silex\Application();
$app[ 'autoloader' ]->registerNamespaces($vendor);
$app[ 'autoloader' ]->registerNamespace('DA', APPLICATION_PATH);
$app[ 'autoloader' ]->register();

$config = parse_ini_file($configFile,true);
$config2 = array();
array_walk($config, function($val,$key) use (&$config2) { 
    $keys               = explode(" : ", $key);
    $config2[$keys[0]]  = $val;
    if(array_key_exists(1,$keys) && array_key_exists($keys[1], $config2))
        $config2[$keys[0]] = array_merge($config2[$keys[1]],$config2[$keys[0]]);
});

$app['config'] = $config2[APPLICATION_ENV];

return $app;