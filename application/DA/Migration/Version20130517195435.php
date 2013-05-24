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
 * Criação da tabela deputado
 * @package Migration
 */
class Version20130517195435 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `deputado` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `matricula` varchar(255) NOT NULL,
                                    `nome` varchar(255) NOT NULL,
                                    `identificacao` varchar(255) NOT NULL,
                                    `numero` varchar(255) NOT NULL,
                                    `partido` varchar(6) NOT NULL,
                                    `estado` char(2) NOT NULL,
                                    PRIMARY KEY (`id`)
                                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8');
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('deputado');
    }
}
