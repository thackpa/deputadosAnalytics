<?php

namespace Tests\Repository\Presenca;


/**
 * @backupGlobals disabled
 */
class ComissaoTest extends \Tests\Base\DB
{
    
    private $repository;
    protected $app;
    
    protected function setUp() {
        $this->app = \DA\Util\Registry::get("app");
        $this->repository = new \DA\Repository\Presenca\Comissao($this->app);
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
                            'titulo'        => 'Ordinária 003/02',
                            'comportamento' => 'Ausência'
                        ),
                        array(
                            'deputado_id'    => 2,
                            'data'          => date('Y-m-d'),
                            'titulo'        => 'Ordinária 003/02',
                            'comportamento' => 'Ausência'
                        ),
                        array(
                            'deputado_id'    => 3,
                            'data'          => date('Y-m-d'),
                            'titulo'        => 'Ordinária 003/02',
                            'comportamento' => 'Ausência'
                        )
        );
        
        $result = $this->repository->savePresencas($presencas);
        
        $this->assertEquals(count($presencas), count($result));
    }
}