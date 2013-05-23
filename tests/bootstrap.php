<?php 

/**
 * This file is part of the Deputado Analytics System (http://deputadoanalytics.com.br/)
 *
 * @link https://github.com/thackpa/deputadosAnalytics for the canonical source repository 
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

define('APPLICATION_ENV', 'automatedtests');

$app = require __DIR__ . '/../application/bootstrap.php';

DA\Util\Registry::set("app", $app);