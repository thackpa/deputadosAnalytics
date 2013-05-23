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
 * Criação da tabela em presença em Comissões
 * @package Migration
 */
class Version20130517220746 extends AbstractMigration
{

    /**
     * up
     * @param  Schema $schema
     *
     * @return void
     */
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

    /**
     * down
     *
     * @param  Schema $schema
     * @return void
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('presencacomissao');
    }
}
