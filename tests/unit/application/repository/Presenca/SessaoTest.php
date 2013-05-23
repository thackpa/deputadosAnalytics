<?php

namespace DA\Tests\Repository\Presenca;

use DA\Repository\Presenca\Sessao, DA\Util\Registry;

/**
 * @backupGlobals disabled
 */
class SessaoTest extends \Base\DB
{
    
    private $repository;
    protected $app;
    
    protected function setUp() {
        $this->app = Registry::get("app");
        $this->repository = new Sessao($this->app);
        parent::setUp();        
    }
    
    protected function getDataSet()
    {
        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            dirname(__FILE__)."/../../../../data/deputados.yml"
        );        
    }
    
    public function testSavePresenca()
    {
        $presencas = array(
                        array(
                            'deputado_id'    => 1,
                            'data'          => date('Y-m-d'),
                            'justificativa' => 'Compromissos praianos',
                            'titulo'        => 'Ordinária 003/02',
                            'comportamento' => 'Ausência'
                        ),
                        array(
                            'deputado_id'    => 2,
                            'data'          => date('Y-m-d'),
                            'justificativa' => 'Compromissos praianos',
                            'titulo'        => 'Ordinária 003/02',
                            'comportamento' => 'Ausência'
                        ),
                        array(
                            'deputado_id'    => 3,
                            'data'          => date('Y-m-d'),
                            'justificativa' => 'Compromissos praianos',
                            'titulo'        => 'Ordinária 003/02',
                            'comportamento' => 'Ausência'
                        )
        );
        
        $result = $this->repository->savePresencas($presencas);
        
        $this->assertEquals(count($presencas), count($result));
    }
}