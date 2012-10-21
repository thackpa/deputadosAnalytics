<?php

namespace DA\Tests\Builder;

use DA\Util\Registry;

class PresencaTest extends \PHPUnit_Framework_TestCase
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
        
        $this->scrapperMock = $this->getMockBuilder('DA\Scrapper\Presenca')
                                ->setConstructorArgs(array($this->app))
                                ->getMock(); 
        
        $this->repoMock = $this->getMockBuilder('DA\Repository\PresencaSessao')
                                ->setConstructorArgs(array($this->app))
                                ->getMock(); 
        
        $this->builder = new \DA\Builder\Presenca($this->app,$this->scrapperMock,$this->repoMock);
    }
    
    public function testAtualizarPresencasSessao()
    {
//        $info = array();
//        $info['legislatura'] = 54;
//        $info['deputados'] = array(
//            array('matricula' => 1, 'nome' => strtoupper('Jaca Rato'), 'identificacao' => 1, 'numero' => 1, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 2, 'nome' => strtoupper('Jaca Paladium'), 'identificacao' => 2, 'numero' => 2, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 3, 'nome' => strtoupper('Jacaré do  É o Tchan'), 'identificacao' => 3, 'numero' => 3, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 4, 'nome' => strtoupper('Jim'), 'identificacao' => 4, 'numero' => 4, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 5, 'nome' => strtoupper('Stifler'), 'identificacao' => 5, 'numero' => 5, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 6, 'nome' => strtoupper('Finch'), 'identificacao' => 6, 'numero' => 6, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 7, 'nome' => strtoupper('Reginaldo Rossi'), 'identificacao' => 7, 'numero' => 7, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 8, 'nome' => strtoupper('Chimbinha'), 'identificacao' => 8, 'numero' => 8, 'estado' => 'PA', 'partido' => 'PPPPP')
//        );
//        
//        $this->scrapperMock->expects($this->once())
//                            ->method('getMainInfo')
//                            ->will($this->returnValue($info));
//        
//        $deputadosBD = array(
//            array('matricula' => 1, 'nome' => strtoupper('Jaca Rato'), 'identificacao' => 1, 'numero' => 1, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 2, 'nome' => strtoupper('Jaca Paladium'), 'identificacao' => 2, 'numero' => 2, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 3, 'nome' => strtoupper('Jacaré do  É o Tchan'), 'identificacao' => 3, 'numero' => 3, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 4, 'nome' => strtoupper('Jim'), 'identificacao' => 4, 'numero' => 4, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 5, 'nome' => strtoupper('Stifler'), 'identificacao' => 5, 'numero' => 5, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 6, 'nome' => strtoupper('Finch'), 'identificacao' => 6, 'numero' => 6, 'estado' => 'PA', 'partido' => 'PPPPP')
//        );
//        
//        $deputadosNovos = array(
//            array('matricula' => 7, 'nome' => strtoupper('Reginaldo Rossi'), 'identificacao' => 7, 'numero' => 7, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('matricula' => 8, 'nome' => strtoupper('Chimbinha'), 'identificacao' => 8, 'numero' => 8, 'estado' => 'PA', 'partido' => 'PPPPP')
//        );
//        
//        $this->repoMock->expects($this->once())
//                        ->method('getDeputadosAtuais')
//                        ->will($this->returnValue($deputadosBD));
//        
//        $this->repoMock->expects($this->once())
//                ->method('inserirNovosDeputados')
//                ->with($deputadosNovos)
//                ->will($this->returnValue(array(1, 1)));
        
        //pensar quando um deputado nao está mais na lista de deputados atuais, como tira-lo ?
        
        //Pegar a lesgislatura atual
        //Pegar o array de deputados com a data da ultima atualizacao de presenca pra eles
        //Pegar a ultima data processada ou comecar por 01/01/2012
        //Pegar um mes
        //iterar sobre os deputados passando os parametros corretos
        //receber o resultado
        //passar para o repository salvar
        
        //se a ultima data estiver num intervalo menor que dois meses, nao mandar o scrapper pegar - falar que está atualizado
        //colocar isso no log - deputado e data
        
        $this->builder->atualizarPresencasSessao();
    }
}
