<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130517220207 extends AbstractMigration
{
	public function up(Schema $schema)
	{
		$this->addSql('CREATE TABLE IF NOT EXISTS presencasessao (
							id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
							deputadoId INT NOT NULL ,
							data DATE NOT NULL,
							titulo VARCHAR(255) NOT NULL,
							comportamento VARCHAR(255) NOT NULL ,
							justificativa VARCHAR(255) NOT NULL
						) ENGINE = InnoDB' );
	}

	public function down(Schema $schema)
	{
		$schema->dropTable('presencasessao');
	}
}
