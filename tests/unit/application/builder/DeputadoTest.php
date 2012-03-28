<?php

namespace DA\Tests\Builder;

use DA\Builder\DeputadoData, DA\Util\Registry;

class DeputadoTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var DA\Builder\Deputado
     */
    
    private $builder;
    
    protected function setUp() {
        parent::setUp();        
        $this->app = Registry::get("app");
        
        $this->builder = $this->getMockBuilder('DA\Builder\DeputadoData')->setConstructorArgs(array($this->app))->getMock(); 
    }
    
    protected function tearDown() {
        parent::tearDown();
    }
    
    
    public function testAtualizarListaDeputados()
    {
        $this->builder->atualizarListaDeputados();
    }
    
    
    public function testAtualizarDeputados()
    {
        $this->builder->atualizarDeputados($listaDep);
    }
    
    public function testGetDeputadosAtuais()
    {
        $this->builder->getDeputadosAtuais();
    }
    
    public function testDepToListaMatriculas()
    {
        $this->builder->depToListaMatriculas($deputados);
    }
    
}