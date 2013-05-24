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

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Criação da tabela legislatura
 * @package Migration
 */
class Version20130517221811 extends AbstractMigration
{

    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `legislatura` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `numero` int(5) NOT NULL,
          `atual` int(1) NOT NULL,
          `data` date NOT NULL,
          PRIMARY KEY (`id`)
          ) ENGINE=InnoDB  DEFAULT CHARSET=utf8' );
    }

    public function down(Schema $schema)
    {
            $schema->dropTable('legislatura');
    }
}
