<?php

namespace DA\Tests\Repository;

use DA\Repository\Legislatura, DA\Util\Registry;

class LegislaturaTest extends \Base\DB
{
    
    private $repository;
    protected $app;
    
    protected function setUp() {
        $this->app = Registry::get("app");
        $this->repository = new Legislatura($this->app);
        parent::setUp();        
    }
    
    protected function getDataSet()
    {
        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            dirname(__FILE__)."/../../../data/deputados.yml"
        );        
    }
    
    public function testAtualizarSessaoAtual()
    {
        $legislatura = 100;
        $retorno = $this->repository->atualizarLegislaturaAtual($legislatura);
        
        $legislaturaAtual = $this->repository->getLegislaturaAtual();
        
        $this->assertEquals($legislaturaAtual['numero'], $legislatura);
    }
    
    public function testeGetLegislaturaAtual()
    {
        $legislatura = $this->repository->getLegislaturaAtual();
        
        $legislaturaExp = array('id' => '1', 'numero' => '53', 'atual' => '1', 'data' => '2010-01-01');
        
        $this->assertSame($legislaturaExp, $legislatura);
    }
}
