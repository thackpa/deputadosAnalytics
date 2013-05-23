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

class Version20130517221811 extends AbstractMigration
{

    /**
     * up
     * @param  Schema $schema
     *
     * @return void
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS legislatura (
                        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                        numero INT(5) NOT NULL ,
                        atual INT(1) NOT NULL,
                        data DATE NOT NULL
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
          $schema->dropTable('legislatura');
    }
}
