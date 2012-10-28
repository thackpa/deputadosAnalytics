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
        
        $data = $this->scrapper->getPresencas(54, 54, 123, '11/11/2011', '11/11/2012');
        
        $this->assertTrue(is_array($data[0]));
        $this->assertTrue(is_numeric($data[0]['deputadoId']));
        $this->assertTrue(is_string($data[0]['data']));      
        $this->assertTrue(is_string($data[0]['comissao']));
        $this->assertTrue(is_string($data[0]['comportamento']));
    }
}