<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130517220746 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `presencacomissao` (
						  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
						  deputadoId int(11) NOT NULL,
						  data date NOT NULL,
						  titulo varchar(255) NOT NULL,
						  tipo varchar(255) NOT NULL,
						  comportamento varchar(255) NOT NULL
					) ENGINE = InnoDB' );
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('presencacomissao');
    }
}
