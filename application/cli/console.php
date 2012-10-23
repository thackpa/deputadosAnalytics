#!/usr/bin/env php
<?php
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'dev'));

//define('APPLICATION_ENV','dev');

$app = require __DIR__ . '/../bootstrap.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$console = new Application('Deputados Analytics', '0.1');

$console->register('atualizar')
        ->setDefinition(
                array(
                  new InputOption('deputados', '', InputOption::VALUE_NONE, 'Extracao de Deputados'),
                  new InputOption('presencas', '', InputOption::VALUE_NONE, 'Extracao de Presencas')
                )
        )
        ->setDescription('Extracao de informacoes')
        ->setHelp('Uso: <info>./console.php atualizar [--deputados|--presencas]</info>')
        ->setCode(
            function(InputInterface $input, OutputInterface $output) use ($app) {
              if ($input->getOption('deputados')) {
                $output->write("\n\tRecuperacao de Deputados Iniciada\n\n");
                
                $deputadoBuilder = new DA\Builder\Deputado($app);
                $deputadoBuilder->atualizarListaDeputados();
                
                $output->write("\n\tFim da Recuperacao de Deputados \n\n");
              } else if($input->getOption('presencas')) {
                $output->write("\n\tRecuperacao de Presenças de Sessão Iniciada\n\n");
                
                $mes = 4;
                
                $presencasBuilder = new DA\Builder\Presenca($app);
                $presencasBuilder->atualizarPresencasSessao($mes);
                
                $output->write("\n\tFim da Recuperacao de Presenças de Sessão\n\n");
              }
            

            }
);

$console->run();