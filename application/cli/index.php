#!/usr/bin/env php
<?php

//defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'dev'));

define('APPLICATION_ENV','dev');

$app = require __DIR__ . '/../bootstrap.php';


use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$console = new Application('Deputados Analytics', '0.1');

$console->register( 'extrair' )
  ->setDefinition( array(
     new InputOption('deputados', '', InputOption::VALUE_NONE, 'Extracao de Deputados'),
    ) )
  ->setDescription('Extracao de informacoes')
  ->setHelp('Uso: <info>./console.php extrair [--deputados]</info>')
  ->setCode(
    function(InputInterface $input, OutputInterface $output) use ($app)
    {
//      $output->write("\n\t".$app['config']['url.deputados']."\n\n");
      
      if ($input->getOption('deputados')){
        $output->write("\n\tDeputados Retrieving enabled\n\n");
      }

      $deputadosScrapper = new DA\Scrapper\Deputado($app);
      $deputadosScrapper->getAll();
      
      //$output->write( "Contacting external data source ...\n");
      //Do work here
      //Example:
      //  $app[ 'myExtension' ]->doStuff();
    }
  );

$console->run();