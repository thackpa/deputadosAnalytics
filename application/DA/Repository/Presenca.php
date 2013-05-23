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
use DA\Repository\Repository;

/**
 * Classe Abstrata responsavel por servir de Base para o
 * armazenamento das Presencas em Reuniões de Comissão e Sesões do Plenario
 *
 * @package       Repository
 * @subpackage Presenca
 */
abstract class Presenca extends Repository
{
    /**
     * Tabela onde serão salvas as presencas no Banco de Dados
     * @var string
     */
    protected $dbTable;

    /**
     * Armazena as Presencas na DB
     * @param  array $presencas array de presencas a serem armazenadas
     *
     * @return  array [description]
     */
    public function savePresencas(array $presencas)
    {
        $res = array();
        foreach ($presencas as $presenca) {
            $res[] = $this->getDb()->insert($this->dbTable, $presenca);
        }

        return $res;
    }

}
