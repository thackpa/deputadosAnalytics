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

namespace DA\Console;

/**
 * Uma Aplicação Console
 * @package Console
 */
class Application extends \Symfony\Component\Console\Application
{
    /**
     * Objeto da Aplicação
     * @var Silex\Application
     */
    private $app;

    /**
     * Instancia de conexão com o Banco
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Configura os Helpers necessários
     * @return void
     */
    public function configureHelpers()
    {
        $helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
            'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($this->db),
            'dialog' => new \Symfony\Component\Console\Helper\DialogHelper(),
        ));

        $this->setHelperSet($helperSet);
    }

    /**
     * Conecta ao banco e salva na propriedade DB
     * @return void
     */
    private function connect()
    {
        $this->app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
            'db.options'    => array(
                    'driver'        => $this->app['config']['bd.driver'],
                    'host'          => $this->app['config']['bd.host'],
                    'dbname'    => $this->app['config']['bd.name'],
                    'user'          => $this->app['config']['bd.user'],
                    'password'  => $this->app['config']['bd.pass'],
                ),
            'db.dbal.class_path'          => __DIR__.'/vendor/doctrine-dbal/lib',
            'db.common.class_path'  => __DIR__.'/vendor/doctrine-common/lib',
            ));
        $this->db = $this->app['db'];
    }

    /**
     * Configura os Recursos necessários para Aplicação
     * @param  \Silex\Application $app
     *
     * @return void
     */
    public function setup(\Silex\Application $app)
    {
        $this->app = $app;
        $this->connect();
        $this->configureHelpers();
    }
}
