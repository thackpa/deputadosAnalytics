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
 * Classe responsável por construir e utilizar os recursos necessários para
 * extração e atualização dos Deputados
 *
 * @package Builder
 */
class Deputado extends Builder
{

    /**
     * Deputado Scrapper
     * @var \DA\Scrapper
     */
    private $deputadoScrapper;

    /**
     * Deputado Repository
     * @var \DA\Repository
     */
    private $deputadoRepository;

    /**
     * Legislatura Repository
     * @var \DA\Repository
     */
    private $legislaturaRepository;

    /**
     * Inicializa as principais variaveis para realização da
     * exração e armazenamento dos dados dos Deputados
     *
     * @param Silex\Application $app
     * @param \DA\Scrapper      $scrapper
     * @param \DA\Repository    $repository
     * @param \DA\Repository    $legislaturaRepository
     */
    public function __construct($app, $scrapper = null, $repository = null, $legislaturaRepository = null)
    {
        parent::__construct($app);

        if (! $scrapper) {
            $this->deputadoScrapper     = new \DA\Scrapper\Deputado($app);
        } else {
            $this->deputadoScrapper     = $scrapper;
        }

        if (!$repository) {
            $this->deputadoRepository   = new \DA\Repository\Deputado($app);
        } else {
            $this->deputadoRepository   = $repository;
        }

        if (is_null($legislaturaRepository)) {
            $this->legislaturaRepository   = new \DA\Repository\Legislatura($app);
        } else {
            $this->legislaturaRepository   = $legislaturaRepository;
        }
    }

    /**
     * Atualiza a Lista dos Deputados
     *  @return void
     *  @todo refatorar atualizarListaDeputados(), muito grande, 4 responsabilidades
     */
    public function atualizarListaDeputados()
    {
      $this->app['monolog']->info("\n\n Iniciando a atualizacao de deputados!");

      $info = $this->deputadoScrapper->getMainInfo();

      $this->app['monolog']->info(sprintf("Recuperados %s deputados da página
          para a legislatura %s.", count($info['deputados']),
              $info['legislatura']));

      $retorno = $this->legislaturaRepository->atualizarLegislaturaAtual($info['legislatura']);

      $matriculasOnline = $this->getMatriculasFromArray($info['deputados']);

      $deputadosBD      = $this->deputadoRepository->getDeputadosAtuais();
      $matriculasBD     = $this->getMatriculasFromArray($deputadosBD);

      $novasMatriculas  = array_diff($matriculasOnline, $matriculasBD);

      $novosDeputados   = $this->getNovosDeputados($info['deputados'], $novasMatriculas);

      $this->app['monolog']->info(sprintf("Diferenca de %s novos deputados.", count($novosDeputados)));

      $retorno = $this->deputadoRepository->inserirNovosDeputados($novosDeputados);

      $this->app['monolog']->info(sprintf("Inseridos %s novos deputados.", count($retorno)));
    }

    /**
     * Recebe um array com as novas matrículas e deputados e retorna
     * os deputados que ainda não estão armazenados no banco de dados.
     *
     * @param array $deputados  Array com todos Deputados
     * @param array $matriculas Array com novas Matrículas
     *
     * @return array Array com novos Deputados
     * @todo Otimizar método getNovosDeputados()
     */
    private function getNovosDeputados(array $deputados, array $matriculas)
    {
        $novos = array();
        foreach ($deputados as $deputado) {
            if($matriculas)
                foreach ($matriculas as $matricula) {
                    if ($matricula == $deputado['matricula']) {
                        $novos[] = $deputado;
                    }
                }
        }

        return $novos;
    }

    /**
     * Retorna apenas as matrículas de um array com os dados dos Deputados
     * @param array $deputados Array com os dados do Deputado
     *
     * @return array retorna um array contendo apenas as matriculas
     */
    private function getMatriculasFromArray(array $deputados)
    {
        $matriculas = array();
        array_walk($deputados,
                function ($deputado) use (&$matriculas) {
                    $matriculas[] = $deputado['matricula'];
                }
        );

        return $matriculas;
    }

}
