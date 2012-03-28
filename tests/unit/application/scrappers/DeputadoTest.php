<?php

use DA\Scrapper\Deputado;

class DeputadoTest extends PHPUnit_Framework_TestCase
{
    
    private $scrapper;
    
    protected function setUp() {
        parent::setUp();        
        $this->app = DA\Util\Registry::get("app");
        
        $this->scrapper = $this->getMockBuilder('DA\Scrapper\Deputado')->setConstructorArgs(array($this->app))->setMethods(array('request'))->getMock(); 
    }
    
    protected function tearDown() {
        parent::tearDown();
    }
    
    public function testGetAll()
    {
        $content = file_get_contents(__DIR__.'/../../../data/'.$this->app['config']['url.deputados']);
        $crawler = new Symfony\Component\DomCrawler\Crawler(null, $this->app['config']['url.deputados']);
        $crawler->addContent($content);

//        $client = $this->getMockBuilder('Symfony\Component\BrowserKit\Client')->getMockForAbstractClass();
//        $client->expects($this->once())->method('request')->will($this->returnValue($crawler));
	//$this->scrapper->expects($this->once())->method('getClient')->will($this->returnValue($client));
        
        $this->scrapper->expects($this->once())->method('request')->with($this->app['config']['url.deputados'])->will($this->returnValue($crawler));
        $deputados = $this->scrapper->getAll();
        
        $this->assertTrue(is_array($deputados[0]));
        $this->assertTrue(is_numeric($deputados[0][0]));
        $this->assertTrue(is_string($deputados[0][1]));
        $this->assertEquals(513,count($deputados));
        $this->assertEquals(509,array_search(array(74354,strtoupper("ZENALDO COUTINHO")), $deputados));
    }
    
}
