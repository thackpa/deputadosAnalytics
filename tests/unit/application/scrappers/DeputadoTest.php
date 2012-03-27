<?php

use DA\Scrapper\Deputado;

class DeputadoTest extends PHPUnit_Framework_TestCase
{
    
    private $scrapper;
    
    protected function setUp() {
        parent::setUp();        
        $app = DA\Util\Registry::get("app");
        $this->scrapper = new Deputado($app);
    }
    
    protected function tearDown() {
        parent::tearDown();
    }
    
    public function testGetAll()
    {
        //$this->scrapper->getAll();
    }
    
}