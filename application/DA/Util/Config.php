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

namespace DA\Util;

/**
 * Armazena as configurações da Aplicação
 *
 * @package       Default
 * @subpackage Util
 */
class Config extends \Pimple
{
    /**
     * Metodo construtor
     * @param string $configFile path para o arquivo de configuração
     */
    public function __construct($configFile)
    {
        $baseConfig = parse_ini_file($configFile,true);
        $config = $this->setConfigInheritance($baseConfig);
        $this['config'] = $config[APPLICATION_ENV];
    }

    /**
     * Configura a herança de configurações entre diferenes ambientes
     * @param array $baseConfig Array com a configuração base para cada ambiente
     *
     * @return array Array com as configurações completas com dados herdados
     */
    protected function setConfigInheritance ( $baseConfig )
    {
        $config = array();

        array_walk($baseConfig, function($val,$key) use (&$config) {

            $keys = explode(" : ", $key);
            $config[$keys[0]]  = $val;

            if(array_key_exists(1,$keys) && array_key_exists($keys[1], $config))
                $config[$keys[0]] = array_merge($config[$keys[1]],$config[$keys[0]]);
        });

        return $config;

    }
}
