<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130517222924 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO legislatura VALUES ('', 54, 1, '2012-02-02')");
    }

    public function down(Schema $schema)
    {        
    	$this->addSql("DELETE FROM legislatura WHERE numero=54");
    }
}
