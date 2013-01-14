<?php
date_default_timezone_set('America/Sao_Paulo');
defined('APPLICATION_PATH') || define('APPLICATION_PATH', __DIR__);

require __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

//Change to Pimple
$configFile = APPLICATION_PATH."/../config/config.ini";
$config = parse_ini_file($configFile,true);
$config2 = array();
array_walk($config, function($val,$key) use (&$config2) { 
    $keys               = explode(" : ", $key);
    $config2[$keys[0]]  = $val;
    if(array_key_exists(1,$keys) && array_key_exists($keys[1], $config2))
        $config2[$keys[0]] = array_merge($config2[$keys[1]],$config2[$keys[0]]);
});

$app['config'] = $config2[APPLICATION_ENV];
//End to change to pimple

if(APPLICATION_ENV != 'automatedtests') {
    $app->register(new Silex\Provider\MonologServiceProvider(), array(
        'monolog.logfile' => __DIR__.'/../log/live.log',
    ));
} else {
    $app['monolog'] = new \Symfony\Component\HttpKernel\Log\NullLogger();
}

return $app;
