<?php 

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'automatedtests'));

$app = require __DIR__ . '/../application/bootstrap.php';

DA\Util\Registry::set("app", $app);