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
 * Classe responsável por persistir os dados de Legislaturas
 *
 * @package Repository
 */
class Legislatura extends Repository
{

    /**
     * Atualiza o numero da atual Legislatura
     * @param int $legislatura [description]
     *
     * @return bool
     */
    public function atualizarLegislaturaAtual($legislatura)
    {
        $query = 'UPDATE legislatura SET numero = ? WHERE atual = 1';
        return $this->getDb()->executeUpdate($query, array($legislatura));
    }

    /**
     * Retorna a Legislatura atual
     * @return array Dados da legislatura atual
     */
    public function getLegislaturaAtual()
    {
        $legislaturaAtual = $this->getDb()->fetchAssoc("SELECT * FROM legislatura WHERE atual = 1");

        if(!$legislaturaAtual)

            return array();
        else
            return $legislaturaAtual;
    }

}
