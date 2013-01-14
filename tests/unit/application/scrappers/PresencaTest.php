<?php
namespace DA\Tests\Scrapper;

class PresencaSessaoTest extends \Base\Scrapper
{
    
    protected function setUp() {
        parent::setUp('DA\Scrapper\Presenca');        
    }
    
    public function testGetPresencas()
    {
        $this->setDataFromUrl('url.presencaPlenario');
        
        $data = $this->scrapper->getPresencas(1, 54, 123, '11/11/2011', '11/11/2012');
        
        $this->assertTrue(is_array($data[0]));
        $this->assertTrue(is_numeric($data[0]['deputadoId']));
        $this->assertTrue(is_string($data[0]['data']));
        $this->assertTrue(is_string($data[0]['justificativa']));
        $this->assertTrue(is_string($data[0]['sessao']));
        $this->assertTrue(is_string($data[0]['comportamento']));
    }
}