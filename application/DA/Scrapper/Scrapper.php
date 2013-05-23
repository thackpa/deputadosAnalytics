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

namespace DA\Scrapper;

use Goutte\Client;

/**
 * Scrapper Base
 * @package Scrapper
 */
class Scrapper
{
    /**
     * The Goutte Scrapper
     * @var Goutte\Client
     */
    protected $client;

    /**
     * Objeto da Aplicação
     * @var \Silex\Application
     */
    protected $app;

    /**
     * Scrapper construtor
     * @param \Silex\Application $app
     */
    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
        $this->client = new Client();
    }

    /**
     * Get the Goutte Scrapper objetct
     * @return Goutte\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Retorna um Crawler com acesso a URI passada
     * @param  string  $url The URI to fetch
     * @return Crawler
     */
    public function request($url)
    {
        return $this->getClient()->request('GET', $url);
    }
}
