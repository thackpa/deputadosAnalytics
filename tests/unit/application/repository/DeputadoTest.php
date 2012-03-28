<?php

namespace DA\Tests\Repository;

use DA\Repository\Deputado, DA\Util\Registry;

class DeputadoTest extends \PHPUnit_Framework_TestCase
{
    
    private $repository;
    private $app;
    
    protected function setUp() {
        parent::setUp();        
        $this->app = Registry::get("app");
        $this->repository = new Deputado($this->app);
        //$this->repository = $this->getMockBuilder('DA\Repository\Deputado')->setConstructorArgs(array($this->app))->getMock(); 
    }
    
    protected function tearDown() {
        parent::tearDown();
    }
    
    public function testGetDeputadosAtuais()
    {
        $this->repository->getDeputadosAtuais();
    }
    
}