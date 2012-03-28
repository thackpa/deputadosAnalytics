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
  ->setDefinition( array(
     new InputOption('deputados', '', InputOption::VALUE_NONE, 'Extracao de Deputados'),
    ) )
  ->setDescription('Extracao de informacoes')
  ->setHelp('Uso: <info>./console.php atualizar [--deputados]</info>')
  ->setCode(
    function(InputInterface $input, OutputInterface $output) use ($app)
    { 
      if ($input->getOption('deputados')){
        $output->write("\n\tDeputados Retrieving enabled\n\n");
      }

      $deputadoBuilder = new DA\Builder\Deputado();
      $deputadoBuilder->atualizarListaDeputados($app);
    }
  );

$console->run();
