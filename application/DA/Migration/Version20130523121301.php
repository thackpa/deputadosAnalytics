<?php

namespace DA\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Renomeia as tabelas presencacomissao e presencasessao para 
 * presenca_comissao e presenca_sessao
 * @package Migration
 */
class Version20130523121301 extends AbstractMigration
{

  public function up(Schema $schema)
  {
      $this->addSql("CREATE TABLE IF NOT EXISTS `cota_parlamentar` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `identificacao` int(11) NOT NULL,
        `deputado_id` int(11) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `fk_cota_parlamentar_1` (`deputado_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

  }

  public function down(Schema $schema)
  {
      $schema->dropTable('cota_parlamentar');    
  }

}
