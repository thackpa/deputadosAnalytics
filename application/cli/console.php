#!/usr/bin/env php
<?php
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'dev'));

$app = require __DIR__ . '/../bootstrap.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use DA\Console\Command\Atualizar;


$application = new Application('Deputados Analytics', '0.1');
$application->add(new Atualizar($app));
$application->run();