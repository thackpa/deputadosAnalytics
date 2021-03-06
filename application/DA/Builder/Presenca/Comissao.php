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

namespace DA\Builder\Presenca;
use DA\Builder\Presenca;

/**
 * Classe responsável por construir e utilizar os recursos necessários para
 * extração e atualização das Presencas em Reuniões de Comissão
 *
 * @package Builder
 * @subpackage Presenca
 */
class Comissao extends Presenca
{

    /**
     * Inicializa as principais variaveis para realização da exração
     * e armazenamento das Presencas em Reuniões de Comissão
     *
     * @param Silex\Application $app
     * @param \DA\Scrapper      $scrapper
     * @param \DA\Repository    $repository
     * @param \DA\Repository    $legislaturaRepository
     * @param \DA\Repository    $deputadoRepository
     */
    public function __construct($app, $scrapper = null, $repository = null, $legislaturaRepository = null, $deputadoRepository = null)
    {
        parent::__construct($app);

        if (! $scrapper) {
            $this->presencaScrapper     = new \DA\Scrapper\Presenca\Comissao($app);
        } else {
            $this->presencaScrapper     = $scrapper;
        }

        if (!$repository) {
            $this->presencaRepository   = new \DA\Repository\Presenca\Comissao($app);
        } else {
            $this->presencaRepository   = $repository;
        }

        if (!$legislaturaRepository) {
            $this->legislaturaRepository   = new \DA\Repository\Legislatura($app);
        } else {
            $this->legislaturaRepository   = $legislaturaRepository;
        }

        if (!$deputadoRepository) {
            $this->deputadoRepository   = new \DA\Repository\Deputado($app);
        } else {
            $this->deputadoRepository   = $deputadoRepository;
        }
    }

    /**
     * Extrai e atualiza no banco as Presencas
     * @param  int  $mes mes que será feita a extração
     * @return void
     */
    public function atualizarPresencas($mes = null)
    {
        if (is_null($mes)) {
            $mes = date("m");
        }

        $datas = $this->getDatas4Extracao($mes);

        $legislatura = $this->legislaturaRepository->getLegislaturaAtual();
        $deputados = $this->deputadoRepository->getDeputadosAtuais();

        foreach ($deputados as $deputado) {

            $this->app['monolog']->info(sprintf("Iniciando a extracao para o deputado %s.", $deputado['nome']));

            $urlParams = array(
                'legislatura'    => $legislatura['numero'],
                'last3Matricula' => substr($deputado['matricula'], -3),
                'dataInicio'     => $datas['dataInicio'],
                'dataFim'        => $datas['dataFim'],
                'numero'         => $deputado['numero']
            );

            $presencas = $this->presencaScrapper->getPresencas($deputado['id'], $urlParams);

            $this->app['monolog']->info(sprintf("Recuperado %s presencas para o deputado %s.", count($presencas), $deputado['nome']));

            $retorno = $this->presencaRepository->savePresencas($presencas);

            $this->app['monolog']->info(sprintf("Salvo %s presencas.", count($retorno)));
        }
    }
}
