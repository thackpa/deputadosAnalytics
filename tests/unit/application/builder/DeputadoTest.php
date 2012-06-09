<?php

namespace DA\Tests\Builder;

use DA\Util\Registry;

class DeputadoTest extends \PHPUnit_Framework_TestCase
{
    
    private $app;
    
    /**
     *
     * @var DA\Builder\Deputado
     */
    private $builder;
    
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject 
     */
    private $scrapperMock;
    
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject 
     */
    private $repoMock;
    
    protected function setUp() {
        parent::setUp();        
        $this->app      = Registry::get("app");
        
        $this->scrapperMock = $this->getMockBuilder('DA\Scrapper\Deputado')
                                ->setConstructorArgs(array($this->app))
                                ->getMock(); 
        
        $this->repoMock = $this->getMockBuilder('DA\Repository\Deputado')
                                ->setConstructorArgs(array($this->app))
                                ->getMock(); 
        
        $this->builder = new \DA\Builder\Deputado($this->app,$this->scrapperMock,$this->repoMock);
        
        //$this->setProtectedAtributes('');
    }
    
    protected function tearDown() {
        parent::tearDown();
    }
    
    public function testAtualizarListaDeputados()
    {
        $deputadosOnline = array(
            array('matricula' => 1, 'nome' => strtoupper('Jaca Rato')),
            array('matricula' => 2, 'nome' => strtoupper('Jaca Paladium')),
            array('matricula' => 3, 'nome' => strtoupper('Jacaré do  É o Tchan')),
            array('matricula' => 4, 'nome' => strtoupper('Jim')),
            array('matricula' => 5, 'nome' => strtoupper('Stifler')),
            array('matricula' => 6, 'nome' => strtoupper('Finch')),
            array('matricula' => 7, 'nome' => strtoupper('Reginaldo Rossi')),
            array('matricula' => 8, 'nome' => strtoupper('Chimbinha'))
        );
        
        $this->scrapperMock->expects($this->once())->method('getAll')->will($this->returnValue($deputadosOnline));
        
        $deputadosBD = array(
            array('matricula' => 1, 'nome' => strtoupper('Jaca Rato')),
            array('matricula' => 2, 'nome' => strtoupper('Jaca Paladium')),
            array('matricula' => 3, 'nome' => strtoupper('Jacaré do  É o Tchan')),
            array('matricula' => 4, 'nome' => strtoupper('Jim')),
            array('matricula' => 5, 'nome' => strtoupper('Stifler')),
            array('matricula' => 6, 'nome' => strtoupper('Finch'))
        );
        
        $deputadosNovos = array(
            array('matricula' => 7, 'nome' => strtoupper('Reginaldo Rossi')),
            array('matricula' => 8, 'nome' => strtoupper('Chimbinha'))
        );
        
        $this->repoMock->expects($this->once())->method('getDeputadosAtuais')->will($this->returnValue($deputadosBD));
        
        $this->repoMock->expects($this->once())->method('inserirNovosDeputados')
                ->with($deputadosNovos)
                ->will($this->returnValue(true));
        
        $this->builder->atualizarListaDeputados();
    }

}