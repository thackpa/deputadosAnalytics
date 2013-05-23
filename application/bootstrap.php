<?php

/**
 * This file is part of the Deputado Analytics System (http://deputadoanalytics.com.br/)
 *
 * @link https://github.com/thackpa/deputadosAnalytics for the canonical source repository
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

date_default_timezone_set('America/Sao_Paulo');
defined('APPLICATION_PATH') || define('APPLICATION_PATH', __DIR__);

require __DIR__.'/../vendor/autoload.php';

$app     = new Silex\Application();
$config = new DA\Util\Config( APPLICATION_PATH."/../config/config.ini" );

$app['config'] = $config['config'];

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../log/live.log',
    ));

return $app;
