<?php

namespace DA\Tests\Builder\Presenca;

use DA\Util\Registry;

class SessaoTest extends \PHPUnit_Framework_TestCase
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
    
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject 
     */
    private $repoLegislaturaMock;
    
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject 
     */
    private $repoDeputadoMock;
    
    protected function setUp() {
        parent::setUp();        
        $this->app      = Registry::get("app");
        
        $this->scrapperMock = $this->getMockBuilder('DA\Scrapper\Presenca\Sessao')
                                ->setConstructorArgs(array($this->app))
                                ->getMock(); 
        
        $this->repoMock = $this->getMockBuilder('DA\Repository\Presenca\Sessao')
                                ->setConstructorArgs(array($this->app))
                                ->getMock(); 
        
        $this->repoLegislaturaMock = $this->getMockBuilder('DA\Repository\Legislatura')
                                ->setConstructorArgs(array($this->app))
                                ->getMock(); 
        
        $this->repoDeputadoMock = $this->getMockBuilder('DA\Repository\Deputado')
                                ->setConstructorArgs(array($this->app))
                                ->getMock(); 
        
        $this->builder = new \DA\Builder\Presenca\Sessao($this->app,$this->scrapperMock,$this->repoMock, $this->repoLegislaturaMock, $this->repoDeputadoMock);
    }
    
    public function testAtualizarPresencasSessao()
    {
        $mesEntrada = '1';
        $mes = str_pad($mesEntrada, 2, '0', STR_PAD_LEFT);
        $ano = date('Y');
        $dataInicio = "01/$mes/$ano";
        $dataFim = "31/$mes/$ano";
        
        $legislatura = array('id' => '1', 'numero' => '54', 'atual' => '1', 'data' => '2010-01-01');
        $this->repoLegislaturaMock->expects($this->once())
                ->method('getLegislaturaAtual')
                ->will($this->returnValue($legislatura));
        
        $deputadosBD = array(
            array('id'=> 1, 'matricula' => 1, 'nome' => strtoupper('Jaca Rato'), 'identificacao' => 1, 'numero' => 1, 'estado' => 'PA', 'partido' => 'PPPPP'),
            array('id'=> 2, 'matricula' => 2, 'nome' => strtoupper('Jaca Paladium'), 'identificacao' => 2, 'numero' => 2, 'estado' => 'PA', 'partido' => 'PPPPP'),
//            array('id'=> 3, 'matricula' => 3, 'nome' => strtoupper('Jacaré do  É o Tchan'), 'identificacao' => 3, 'numero' => 3, 'estado' => 'PA', 'partido' => 'PPPPP')
        );
        $this->repoDeputadoMock->expects($this->once())
                ->method('getDeputadosAtuais')
                ->will($this->returnValue($deputadosBD));
        
        $presencas = array( "1" =>
                                array(
                                    array(
                                        'deputadoId'    => 1,
                                        'data'          => date('d/m/Y'),
                                        'justificativa' => 'Compromissos praianos',
                                        'sessao'        => 'Ordinária 003/02',
                                        'comportamento' => 'Ausência'
                                    )
                                ),
                            "2" => array(
                                    array(
                                        'deputadoId'    => 2,
                                        'data'          => date('d/m/Y'),
                                        'justificativa' => 'Compromissos praianos',
                                        'sessao'        => 'Ordinária 003/02',
                                        'comportamento' => 'Ausência'
                                    )
                                ),
                            "3" => array(
                                    array(
                                        'deputadoId'    => 3,
                                        'data'          => date('d/m/Y'),
                                        'justificativa' => 'Compromissos praianos',
                                        'sessao'        => 'Ordinária 003/02',
                                        'comportamento' => 'Ausência'
                                    )
                                )
        );
        
        foreach ($deputadosBD as $deputado) {
            $this->scrapperMock->expects($this->at($deputado['id']-1))
                    ->method('getPresencas')
                    ->with($deputado['id'], $legislatura['numero'], substr($deputado['matricula'], -3), $dataInicio, $dataFim)
                    ->will($this->returnValue($presencas[$deputado['id']]));
            
            $this->repoMock->expects($this->at($deputado['id']-1))
                    ->method('savePresencas')
                    ->with($presencas[$deputado['id']])
                    ->will($this->returnValue(true));
        }
        
        $this->builder->atualizarPresencasSessao($mes);
    }
}
