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

namespace DA\Repository\Presenca;

use DA\Repository\Presenca;

/**
 * Classe responsavel por armazenar no Banco de Dados
 * as Presencas em Reuniões de Comissão
 *
 * @package       Repository
 * @subpackage Presenca
 */
class Comissao extends Presenca
{
    /**
     * Tabela onde serão salvas as presencas no Banco de Dados
     * @var string
     */
    protected $dbTable = 'presenca_comissao';

}
