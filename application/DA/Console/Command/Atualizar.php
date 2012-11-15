<?php
namespace Da\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressHelper;

class Atualizar extends Command
{   
    private $app;

    public function __construct($app)
    {
        parent::__construct();
        $this->app = $app;
    }

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
            ->setHelp('Uso: <info>./console.php atualizar [--deputados|--presencas=comissao|sessao]</info>')
            
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {                
        if ($input->getOption('deputados')) {

            $output->write("\n\tRecuperacao de Deputados Iniciada\n\n");
            $deputadoBuilder = new \DA\Builder\Deputado($this->app);
            $deputadoBuilder->atualizarListaDeputados();

        }else if($input->getOption('presencas')) {

            switch ($input->getOption('presencas')) {
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

        }
    }
}