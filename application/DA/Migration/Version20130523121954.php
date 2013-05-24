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
        $this->addSql('ALTER TABLE `presenca_comissao`
          ADD CONSTRAINT `fk_presenca_comissao_1` 
          FOREIGN KEY (`deputado_id`)
          REFERENCES `deputado` (`id`) 
          ON DELETE NO ACTION 
          ON UPDATE CASCADE');

        $this->addSql('ALTER TABLE `presenca_sessao`
            ADD CONSTRAINT `fk_presenca_sessao_1` 
            FOREIGN KEY (`deputado_id`) 
            REFERENCES `deputado` (`id`) 
            ON DELETE NO ACTION 
            ON UPDATE CASCADE');

        $this->addSql('ALTER TABLE `cota_parlamentar`
            ADD CONSTRAINT `fk_cota_parlamentar_1` 
            FOREIGN KEY (`deputado_id`) 
            REFERENCES `deputado` (`id`) 
            ON DELETE NO ACTION 
            ON UPDATE CASCADE');
    }

    public function down(Schema $schema)
    {        
        $this->addSql('ALTER TABLE  `presenca_comissao` 
          DROP FOREIGN KEY  `fk_presenca_comissao_1`');

        $this->addSql('ALTER TABLE  `presenca_sessao` 
            DROP FOREIGN KEY  `fk_presenca_sessao_1`');        

        $this->addSql('ALTER TABLE  `cota_parlamentar` 
          DROP FOREIGN KEY  `fk_cota_parlamentar_1`');
    }
}
