<?php 

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'automatedtests'));

$app = require __DIR__ . '/../application/bootstrap.php';

DA\Util\Registry::set("app", $app);

//Criar o banco
$config = new \Doctrine\DBAL\Configuration();

$connectionParams = array(
    'dbname' => $app['config']['bd.name'],
    'user' => $app['config']['bd.user'],
    'password' => $app['config']['bd.pass'],
    'host' => $app['config']['bd.host'],
    'driver' => $app['config']['bd.driver'],
);

$conn = Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

$sql = file_get_contents(__DIR__."/../config/database/banco.sql");


$stmt = $conn->query($sql);