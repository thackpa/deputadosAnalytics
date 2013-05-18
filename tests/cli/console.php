#!/usr/bin/env php
<?php
$app = require __DIR__ . '/../bootstrap.php';

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use DA\Console\Application;
use DA\Console\Command\Atualizar;
use DA\Repository\Repository;

$application = new Application('Test Migrations Deputado Analytics', '0.1');
$application->setup($app);

$application->addCommands(array(
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
	));

$application->run();