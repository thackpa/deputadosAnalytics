<?php

namespace DA\Tests\Scrapper;

use DA\Scrapper\Deputado, DA\Util\Registry, Symfony\Component\DomCrawler\Crawler;

class DeputadoTest extends \PHPUnit_Framework_TestCase
{
    
    private $scrapper;
    private $app;
    
    protected function setUp() {
        parent::setUp();        
        $this->app = Registry::get("app");
        
        $this->scrapper = $this->getMockBuilder('DA\Scrapper\Deputado')->setConstructorArgs(array($this->app))->setMethods(array('request'))->getMock(); 
    }
    
    protected function tearDown() {
        parent::tearDown();
    }
    
    public function testGetMainInfo()
    {
        $content = file_get_contents(__DIR__.'/../../../data/'.$this->app['config']['url.deputados']);
        $crawler = new Crawler(null, $this->app['config']['url.deputados']);
        $crawler->addContent($content);
        
        $this->scrapper->expects($this->once())->method('request')->with($this->app['config']['url.deputados'])->will($this->returnValue($crawler));
        $data = $this->scrapper->getMainInfo();
        
        $deputados = $data['deputados'];
        
        $this->assertTrue(is_array($deputados[0]));
        $this->assertTrue(is_numeric($deputados[0]['matricula']));
        $this->assertTrue(is_string($deputados[0]['nome']));
        $this->assertTrue(is_numeric($deputados[0]['numero']));
        $this->assertTrue(is_numeric($deputados[0]['identificacao']));
        $this->assertTrue(is_string($deputados[0]['estado']));
        $this->assertTrue(is_string($deputados[0]['partido']));
        $this->assertEquals(513,count($deputados));
        
        $this->assertEquals('54', $data['legislatura']);
        
    }
    
}
