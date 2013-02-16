<?php
date_default_timezone_set('America/Sao_Paulo');
defined('APPLICATION_PATH') || define('APPLICATION_PATH', __DIR__);

require __DIR__.'/../vendor/autoload.php';


$app = new Silex\Application();
$config = new DA\Util\Config( APPLICATION_PATH."/../config/config.ini" );

$app['config'] = $config['config'];

$app->register(new Silex\Provider\MonologServiceProvider(), array(
	'monolog.logfile' => __DIR__.'/../log/live.log',
	));

return $app;
