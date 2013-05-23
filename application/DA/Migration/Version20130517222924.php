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

class Version20130517222924 extends AbstractMigration
{

    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO legislatura VALUES ('', 54, 1, '2012-02-02')");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DELETE FROM legislatura WHERE numero=54");
    }
}
