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
        $this->repository->getDeputadosAtuais();
    }
    
    public function testInserirNovosDeputados()
    {
        $this->repository->inserirNovosDeputados();
    }
    
}