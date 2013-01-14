<?php

namespace DA\Tests\Repository;
use DA\Repository\Deputado, DA\Util\Registry;

include_once(realpath(__DIR__.'/../../../base/DB.php'));

/**
 * @backupGlobals disabled
 */
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
            realpath(__DIR__."/../../../data/deputados.yml")
        );
    }
    
    public function testGetDeputadosAtuais()
    {
        $deputadosExpected = array(
            array('id' => '1', 'matricula' => '1234', 'nome' => 'Sérgio Malandro', 'identificacao' => '3456', 'numero' => '2345', 'partido' => 'PHAT', 'estado' => 'RJ'),
            array('id' => '2', 'matricula' => '1235', 'nome' => 'Chico Anísio', 'identificacao' => '3457', 'numero' => '2346', 'partido' => 'PHM', 'estado' => 'CE'),
            array('id' => '3', 'matricula' => '1236', 'nome' => 'Millor', 'identificacao' => '3458', 'numero' => '2347', 'partido' => 'PHM', 'estado' => 'SP')
        );
        
        $deputados = $this->repository->getDeputadosAtuais();
        
        $this->assertSame($deputadosExpected, $deputados);
    }
    
    public function testInserirNovosDeputados()
    {
        $deputadosParam = array(
            array('id' => '4', 'matricula' => '1237', 'nome' => 'Rafinha Bastos', 'identificacao' => '3458', 'numero' => '2347', 'partido' => 'PHM', 'estado' => 'RJ'),
            array('id' => '5', 'matricula' => '1238', 'nome' => 'Danilo Gentili', 'identificacao' => '3458', 'numero' => '2347', 'partido' => 'PHM', 'estado' => 'RJ'),
            array('id' => '6', 'matricula' => '1239', 'nome' => 'Marcelo Tas', 'identificacao' => '3458', 'numero' => '2347', 'partido' => 'PHM', 'estado' => 'RJ')
        );
        
        $returned = $this->repository->inserirNovosDeputados($deputadosParam);
        
        $this->assertEquals(count($deputadosParam), count($returned));
    }
    
}
