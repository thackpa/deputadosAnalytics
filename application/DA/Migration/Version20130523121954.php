<?php

namespace DA\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Altera os campos DeputadoId para deputado id
 * @package Migration
 */
class Version20130523121954 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        
        $this->addSql("ALTER TABLE  `presenca_comissao` CHANGE  `deputadoId`  `deputado_id` INT( 11 ) NOT NULL");
        $this->addSql("ALTER TABLE  `presenca_sessao` CHANGE  `deputadoId`  `deputado_id` INT( 11 ) NOT NULL");

    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `presenca_comissao` CHANGE  `deputado_id`  `deputadoId` INT( 11 ) NOT NULL");
        $this->addSql("ALTER TABLE  `presenca_sessao` CHANGE  `deputado_id`  `deputadoId` INT( 11 ) NOT NULL");
    }
}
