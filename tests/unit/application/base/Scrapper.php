<?php

namespace Tests\Base;

use DA\Util\Registry;
use Symfony\Component\DomCrawler\Crawler;

abstract class Scrapper extends \PHPUnit_Framework_TestCase
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
        $path = realpath(APPLICATION_PATH . '/../tests/data/' . $this->app['config'][$url]);

        $this->assertTrue(file_exists($path), "O arquivo ${path} não existe ckeck em: " . $this->app['config'][$url]);

        $content = file_get_contents($path);
        $crawler = new Crawler(null, $this->app['config'][$url]);
        $crawler->addContent($content);

        $this->scrapper->expects($this->once())
                ->method('request')
                ->with($this->app['config'][$url])
                ->will($this->returnValue($crawler));
    }

}