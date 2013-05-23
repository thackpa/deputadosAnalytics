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
 * Criação da tabela de Presenca em Sessões
 * @package Migration
 */
class Version20130517220207 extends AbstractMigration
{
    
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS presencasessao (
                            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                            deputadoId INT NOT NULL ,
                            data DATE NOT NULL,
                            titulo VARCHAR(255) NOT NULL,
                            comportamento VARCHAR(255) NOT NULL ,
                            justificativa VARCHAR(255) NOT NULL
                        ) ENGINE = InnoDB' );
    }
  
    public function down(Schema $schema)
    {
        $schema->dropTable('presencasessao');
    }
}
