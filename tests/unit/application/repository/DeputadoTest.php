<?php

namespace DA\Tests\Repository;

use DA\Repository\Deputado, DA\Util\Registry;

class DeputadoTest extends \Base\DB
{
    
    private $repository;
    protected $app;
    
    protected function setUp() {
        $this->app = Registry::get("app");
        $this->repository = new Deputado($this->app);
        parent::setUp();        
    }
    
    protected function getDataSet()
    {
        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            dirname(__FILE__)."/../../../data/deputados.yml"
        );        
    }


    protected function tearDown() {
        parent::tearDown();
    }
    
    public function testGetDeputadosAtuais()
    {
        $deputadosExpected = array(
            array('id' => '1', 'matricula' => '1234', 'nome' => 'Sérgio Malandro'),
            array('id' => '2', 'matricula' => '1235', 'nome' => 'Chico Anísio'),
            array('id' => '3', 'matricula' => '1236', 'nome' => 'Millor')
        );
        
        $deputados = $this->repository->getDeputadosAtuais();
        
        $this->assertSame($deputadosExpected, $deputados);
    }
    
    public function testInserirNovosDeputados()
    {
        $this->repository->inserirNovosDeputados();
    }
    
}