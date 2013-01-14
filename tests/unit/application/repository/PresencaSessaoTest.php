<?php

namespace DA\Tests\Repository;

use DA\Repository\PresencaSessao, DA\Util\Registry;

class PresencaSessaoTest extends \Base\DB
{
    
    private $repository;
    protected $app;
    
    protected function setUp() {
        $this->app = Registry::get("app");
        $this->repository = new PresencaSessao($this->app);
        parent::setUp();        
    }
    
    protected function getDataSet()
    {
        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            dirname(__FILE__)."/../../../data/deputados.yml"
        );        
    }
    
    public function testSavePresenca()
    {
        $presencas = array(
                        array(
                            'deputadoId'    => 1,
                            'data'          => date('Y-m-d'),
                            'justificativa' => 'Compromissos praianos',
                            'sessao'        => 'Ordinária 003/02',
                            'comportamento' => 'Ausência'
                        ),
                        array(
                            'deputadoId'    => 2,
                            'data'          => date('Y-m-d'),
                            'justificativa' => 'Compromissos praianos',
                            'sessao'        => 'Ordinária 003/02',
                            'comportamento' => 'Ausência'
                        ),
                        array(
                            'deputadoId'    => 3,
                            'data'          => date('Y-m-d'),
                            'justificativa' => 'Compromissos praianos',
                            'sessao'        => 'Ordinária 003/02',
                            'comportamento' => 'Ausência'
                        )
        );
        
        $result = $this->repository->savePresencas($presencas);
        
        $this->assertEquals(count($presencas), count($result));
    }
}