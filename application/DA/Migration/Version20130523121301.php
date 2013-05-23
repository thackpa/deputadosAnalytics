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
      $this->addSql("RENAME TABLE `presencacomissao` TO  `presenca_comissao`");
      $this->addSql("RENAME TABLE `presencasessao` TO  `presenca_sessao`");
    }

    public function down(Schema $schema)
    {
       $this->addSql("RENAME TABLE `presenca_comissao` TO  `presencacomissao`");
       $this->addSql("RENAME TABLE `presenca_sessao` TO  `presencasessao`");  
    }
}
