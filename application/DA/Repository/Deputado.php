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
 * Classe responsável por persistir os dados de Deputados
 * @package Repository
 */
class Deputado extends Repository
{

    /**
     * Retorna os Deputados Atuais
     * @return array Array com todos Deputados  armazenados
     */
    public function getDeputadosAtuais()
    {
        $listaAtual = $this->getDb()->fetchAll("SELECT * FROM deputado");

        if(!$listaAtual)

            return array();
        else
            return $listaAtual;
    }

    /**
     * Insere os Deputados passados como Array
     * @param  array  $deputados [description]
     *
     * @return array  Array com os resultados da inserção
     */
    public function inserirNovosDeputados(array $deputados)
    {
        $res = array();
        foreach ($deputados as $deputado) {
            $res[] = $this->getDb()->insert('deputado', $deputado);
        }

        return $res;
    }

}
