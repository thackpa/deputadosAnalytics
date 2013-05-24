<?php

/**
 * Deputado Analytics (http://deputadoanalytics.com.br/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/thackpa/deputadosAnalytics
 *
 */

namespace DA\Migration;

use Doctrine\DBAL\Migrations\AbstractMigration,
Doctrine\DBAL\Schema\Schema;

/**
 * Criação da tabela presenca_comissao
 * @package Migration
 */
class Version20130517220746 extends AbstractMigration
{
  public function up(Schema $schema)
  {
    $this->addSql('CREATE TABLE IF NOT EXISTS `presenca_comissao` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `deputado_id` int(11) NOT NULL,
      `data` date NOT NULL,
      `titulo` varchar(255) NOT NULL,
      `tipo` varchar(255) NOT NULL,
      `comportamento` varchar(255) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `fk_presenca_comissao_1` (`deputado_id`)      
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8' );
       
  }

  public function down(Schema $schema)
  {
    $schema->dropTable('presenca_comissao');    
  }
}
