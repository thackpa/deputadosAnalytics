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
 * Classe Base responsável por construir e utilizar os recursos necessários para
 * extração e atualização das Presencas
 *
 * @package Builder
 * @subpackage Presenca
 */
abstract class Presenca extends Builder
{
    /**
     * Scrapper de Presenca
     * @var \DA\Scrapper
     */
    protected $presencaScrapper;

    /**
     * Repository de Presenca
     * @var \DA\Repository
     */
    protected $presencaRepository;

    /**
     * Repository de Legislatura
     * @var \DA\Repository
     */
    protected $legislaturaRepository;

    /**
     * Repository de Deputados
     * @var \DA\Repository
     */
    protected $deputadoRepository;

    /**
     * Array com Parametros da URL
     * @var string
     */
    protected $urlParams;

    /**
     * Tranforma o mes passado como parametro em um array
     * contendo o primeiro e ultimo dia deste mes.
     *
     * @param int $mes
     *
     * @return array Array com as keys 'dataInicio' e 'dataFim'
     */
    protected function getDatas4Extracao($mes)
    {
        $endDay = 31;

        if ($mes == 2) {
            $endDay = 28;
        } elseif ($mes % 2 == 0) {
            $endDay = 30;
        }

        $ano = date('Y');
        $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);

        return array("dataInicio" => "01/$mes/$ano", "dataFim" => "$endDay/$mes/$ano");
    }

}
