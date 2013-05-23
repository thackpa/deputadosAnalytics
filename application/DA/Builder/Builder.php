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

namespace DA\Builder;

/**
 * Classe base para construção dos Builders
 *
 * @package Builder
 */
class Builder
{

   /**
    * Objeto da Aplicação
    * @var \Silex\Application
    */
    protected $app;

    /**
     * Construtor do Builder
     * @param \Silex\Application $app
     */
    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
    }
}
