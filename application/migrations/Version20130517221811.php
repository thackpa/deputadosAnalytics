<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130517221811 extends AbstractMigration
{
    public function up(Schema $schema)
    {
    	$this->addSql('CREATE TABLE IF NOT EXISTS legislatura (
					    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					    numero INT(5) NOT NULL ,
					    atual INT(1) NOT NULL,
					    data DATE NOT NULL    
					) ENGINE = InnoDB' );        
    }

    public function down(Schema $schema)
    {
      	$schema->dropTable('legislatura');
    }
}
