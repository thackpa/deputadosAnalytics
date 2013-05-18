<?php 
namespace DA\Console;

class Application extends \Symfony\Component\Console\Application{

	private $app;
    /**
     *
     * @var \Doctrine\DBAL\Connection 
     */
    private $db;


	public function configureHelpers()
	{
		$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
			'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($this->db),
			'dialog' => new \Symfony\Component\Console\Helper\DialogHelper(),
		));

		$this->setHelperSet($helperSet);
	}

	public function connect()
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

	public function setup($app){
		$this->app = $app;
		$this->connect();
		$this->configureHelpers();
	}
}
