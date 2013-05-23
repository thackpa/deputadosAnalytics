<?php

/**
 * Deputado Analytics (http://deputadoanalytics.com.br/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/thackpa/deputadosAnalytics
 *
 */

namespace DA\Repository;

/**
 * Classe base para todos Repository
 *
 * @package Repository
 */
class Repository
{

    /**
     * Objeto da Aplicação
     * @var \Silex\Application
     */
    private $app;

    /**
     * Armazena a conexão com o banco
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Construtor Repository
     * @param \Silex\Application $app
     */
    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
        $this->connect();
    }

    /**
     * Inicializa a conexão com o Banco
     * @return void
     */
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
     * Retorna a conexão
     * @return \Doctrine\DBAL\Connection
     */
    protected function getDb()
    {
        return $this->db;
    }

}
