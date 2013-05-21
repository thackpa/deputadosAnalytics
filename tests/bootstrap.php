<?php 

define('APPLICATION_ENV', 'automatedtests');

$app = require __DIR__ . '/../application/bootstrap.php';

DA\Util\Registry::set("app", $app);


return $app;



/*//Create a simple migration system
$connectionParams = array(
    'dbname' => $app['config']['bd.name'],
    'user' => $app['config']['bd.user'],
    'password' => $app['config']['bd.pass'],
    'host' => $app['config']['bd.host'],
    'driver' => $app['config']['bd.driver'],
);

$conn = Doctrine\DBAL\DriverManager::getConnection($connectionParams);

$sql = file_get_contents(__DIR__."/../config/database/banco.sql");

$stmt = $conn->query($sql);
*/