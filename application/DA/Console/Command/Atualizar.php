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

namespace DA\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Classe Responsável pela execução dos comandos
 * de atualização do Banco de Dados
 *
 * @package       Console
 * @subpackage Command
 */
class Atualizar extends \Symfony\Component\Console\Command\Command
{
    /**
     * Objeto da Aplicação
     * @var \Silex\Application
     */
    private $app;

    /**
     * Construtor  do Commando Atualizar
     * @param \Silex\Application $app
     */
    public function __construct(\Silex\Application $app)
    {
        parent::__construct();
        $this->app = $app;
    }

    /**
     * Define os parametros de configuração do comando
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('atualizar')
            ->setDescription('Atualizar Data Base')
            ->addOption(
               'deputados',
               null,
               InputOption::VALUE_NONE,
               'Extracao de Deputados'
            )
            ->addOption(
               'presencas',
               null,
               InputOption::VALUE_REQUIRED,
               'Extracao de Presencas'
            )
            ->setHelp("Uso: <info>console.php atualizar [--deputados|--presencas=comissao|sessao]</info>\n");
    }

    /**
     * Recebe o comando de atualização de acordo com os parametros passados
     *
     * @param  InputInterface  $input  Parametros de Entrada
     * @param  OutputInterface $output Modo de Saída
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ( $input->getOption('deputados') ) {

            $output->write("\n\tRecuperacao de Deputados Iniciada\n\n");
            $deputadoBuilder = new \DA\Builder\Deputado($this->app);
            $deputadoBuilder->atualizarListaDeputados();

        } elseif ( $input->getOption('presencas' ) ) {

            switch ( $input->getOption('presencas' ) ) {
                case 'sessao':
                    $output->write("\n\tRecuperacao de Presenças de Sessão Iniciada\n\n");
                    $mes = 4;
                    $presencasBuilder = new \DA\Builder\Presenca\Sessao($this->app);
                    $presencasBuilder->atualizarPresencas($mes);
                    $output->write("\n\tFim da Recuperacao de Presenças de Sessão\n\n");
                    break;
                case 'comissao':
                    $output->write("\n\tRecuperacao de Presenças de Comissao Iniciada\n\n");
                    $mes = 4;
                    $presencasBuilder = new \DA\Builder\Presenca\Comissao($this->app);
                    $presencasBuilder->atualizarPresencas($mes);
                    $output->write("\n\tFim da Recuperacao de Presenças de Comissao\n\n");
                    break;
                default:
                    $output->write("\n\tOpção invalida. Tente --presencas=[sessao|comissao] \n\n");
                    break;
            }
        } else {
                $output->write($this->getHelp());
        }
    }
}
