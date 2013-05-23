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
 * Responsavel por armazenar e permitir acesso a recursos
 * compartilhados da Aplicação
 *
 * @package       Default
 * @subpackage Util
 */
class Registry extends \ArrayObject
{

    /**
     * Unica instancia da classe Registry
     *
     * @var Registry
     */
    private static $_registry = null;

    /**
     * Retorna a instancia atual do Registry
     *
     * @return Registry
     */
    public static function getInstance()
    {
        if (self::$_registry === null) {
            self::$_registry = new Registry();
        }

        return self::$_registry;
    }

    /**
     * Retorna um recurso armazenado
     *
     * @param string $index Index de acesso ao recurso
     *
     * @return mix Recurso armazenado
     */
    public static function get($index)
    {
        $instance = self::getInstance();

        if (!$instance->offsetExists($index)) {
            throw new \Exception("No entry is registered for key '$index'");
        }

        return $instance->offsetGet($index);
    }

    /**
     * Armazena um recurso no registro
     *
     * @param string $index Index de acesso ao recurso
     * @param mix  $value Recurso a ser armazenado
     */
    public static function set($index, $value)
    {
        $instance = self::getInstance();
        $instance->offsetSet($index, $value);
    }

    /**
     * Checa se um Index existe no Registry
     *
     * @param  string $index
     *
     * @return bool
     */
    public function offsetExists($index)
    {
        return array_key_exists($index, $this);
    }

    /**
     * Registry construtor
     * @param array  $array [description]
     * @param [type] $flags [description]
     */
    public function __construct($array = array(), $flags = parent::ARRAY_AS_PROPS)
    {
        parent::__construct($array, $flags);
    }

}
