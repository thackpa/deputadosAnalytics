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
 * Criação da tabela de Deputado
 * @package Migration
 */
class Version20130517195435 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS deputado (
                                  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                                  matricula VARCHAR(255) NOT NULL ,
                                  nome VARCHAR(255) NOT NULL,
                                  identificacao VARCHAR(255) NOT NULL ,
                                  numero VARCHAR(255) NOT NULL ,
                                  partido VARCHAR(6) NOT NULL ,
                                  estado CHAR(2) NOT NULL
                              ) ENGINE = InnoDB' );
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('deputado');
    }
}
