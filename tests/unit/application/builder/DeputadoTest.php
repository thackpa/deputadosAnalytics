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
    private $app;
    
    protected function setUp() {
        parent::setUp();        
        $this->app = Registry::get("app");
        
        $this->builder = new DeputadoData($this->app);
        //$this->builder = $this->getMockBuilder('DA\Builder\DeputadoData')->setConstructorArgs(array($this->app))->getMock(); 
    }
    
    protected function tearDown() {
        parent::tearDown();
    }
    

    public function testDepToListaMatriculas()
    {
        $deputados = array(
            array("matricula" => 12344, "nome" => "Jaca Rato"),
            array("matricula" => 12345, "nome" => "Jaca Rato"),
            array("matricula" => 12346, "nome" => "Jaca Rato"),
            array("matricula" => 12347, "nome" => "Jaca Rato"),
            array("matricula" => 12348, "nome" => "Ratao")
        );
        
        $listaMatriculas = array(12344,12345,12346,12347,12348);

        $this->assertEquals($listaMatriculas,$this->builder->depToListaMatriculas($deputados));
    }
    
    /*
    public function testAtualizarListaDeputados()
    {
        $this->builder->atualizarListaDeputados();
    }
    
    
    public function testAtualizarDeputados()
    {
        $this->builder->atualizarDeputados($listaDep);
    }
    

    */

}