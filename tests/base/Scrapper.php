<?php

namespace Base;

use DA\Util\Registry, Symfony\Component\DomCrawler\Crawler;

class Scrapper extends \PHPUnit_Framework_TestCase 
{
    
    protected $scrapper;
    protected $app;
    
    protected function setUp() 
    {
        parent::setUp();        
        $this->app = Registry::get("app");
    }
    
    protected function setScrapperMock($class)
    {
        $this->scrapper = $this->getMockBuilder($class)
                                ->setConstructorArgs(array($this->app))
                                ->setMethods(array('request'))
                                ->getMock(); 
    }
    
    protected function setDataFromUrl($url)
    {
        $path = realpath(__DIR__.'/../data/'.$this->app['config'][$url]);
        $this->assertTrue(file_exists($path), "O arquivo ${path} não existe ckeck em: ".$this->app['config'][$url]);

        $content = file_get_contents($path);
        $crawler = new Crawler(null, $this->app['config'][$url]);
        $crawler->addContent($content);
        
        $this->scrapper->expects($this->once())
                ->method('request')
                ->with($this->app['config'][$url])
                ->will($this->returnValue($crawler));
    }
    
}