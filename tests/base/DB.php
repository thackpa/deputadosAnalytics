<?php

namespace Base;

abstract class DB extends \PHPUnit_Extensions_Database_TestCase
{
    
    static private $pdo = null;

    private $conn = null;

    final public function getConnection()
    {
        $app = $this->app;
        $dns = $app['config']['bd.driverTest'].':dbname='.$app['config']['bd.name'].';host='.$app['config']['bd.host'];
        
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new \PDO($dns, $app['config']['bd.user'], $app['config']['bd.pass']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $app['config']['bd.name']);
        }

        return $this->conn;
    }
    
    
}