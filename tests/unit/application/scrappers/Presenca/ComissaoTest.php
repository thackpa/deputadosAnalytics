<?php
namespace DA\Tests\Scrapper;

class PresencaComissaoTest extends \Base\Scrapper
{
    
    protected function setUp() {
        parent::setUp('DA\Scrapper\Presenca\Comissao');        
    }
    
    public function testGetPresencas()
    {
        $this->setDataFromUrl('url.presencaComissoes');
        
        $urlParams = array(
            'legislatura'    => 54,
            'last3Matricula' => 1,
            'dataInicio'     => '11/11/2012', 
            'dataFim'        => '11/11/2012',
            'numero'         => 1
        );

        $data = $this->scrapper->getPresencas(54, $urlParams);
        
        $this->assertTrue(is_array($data[0]));
        $this->assertTrue(is_numeric($data[0]['deputadoId']));
        $this->assertTrue(is_string($data[0]['data']));      
        $this->assertTrue(is_string($data[0]['tipo']));
        $this->assertTrue(is_string($data[0]['titulo']));
        $this->assertTrue(is_string($data[0]['comportamento']));
    }
}