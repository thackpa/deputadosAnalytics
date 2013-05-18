<?php

namespace DA\Repository;


class Repository
{
    
    private $app;
    /**
     *
     * @var \Doctrine\DBAL\Connection 
     */
    private $db;
    
    public function __construct($app)
    {
        $this->app = $app;
        $this->connect();
    }
    
    protected function connect()
    {
        $this->app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
            'db.options'    => array(
                                        'driver'    => $this->app['config']['bd.driver'],
                                        'host'      => $this->app['config']['bd.host'],
                                        'dbname'    => $this->app['config']['bd.name'],
                                        'user'      => $this->app['config']['bd.user'],
                                        'password'  => $this->app['config']['bd.pass'],
                                    ),
            'db.dbal.class_path'    => __DIR__.'/vendor/doctrine-dbal/lib',
            'db.common.class_path'  => __DIR__.'/vendor/doctrine-common/lib',
        ));
        $this->db = $this->app['db'];
    }
    
    /**
     * 
     * @return \Doctrine\DBAL\Connection
     */
    public function getDb()
    {
        return $this->db;
    }
    
}