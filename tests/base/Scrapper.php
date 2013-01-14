<?php

namespace Base;

use DA\Util\Registry, Symfony\Component\DomCrawler\Crawler;

abstract class Scrapper extends \PHPUnit_Framework_TestCase
{
    protected $scrapper;
    protected $app;
    
    protected function setUp($class) {
        parent::setUp();        
        $this->app = Registry::get("app");
        $this->scrapper = $this->getMockBuilder($class)
                ->setConstructorArgs(array($this->app))
                ->setMethods(array('request'))
                ->getMock(); 
    }
    
    protected function setDataFromUrl($url)
    {
        $content = file_get_contents(__DIR__.'/../data/'.$this->app['config'][$url]);
        $crawler = new Crawler(null, $this->app['config'][$url]);
        $crawler->addContent($content);
        
        $this->scrapper->expects($this->once())
                ->method('request')
                ->with($this->app['config'][$url])
                ->will($this->returnValue($crawler));
    }
    
}