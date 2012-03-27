<?php

namespace DA\Scrapper;

class Deputado extends Scrapper
{
    private $app;
    
    public function __construct($app)
    {
        $this->app = $app;
        parent::__construct();
    }
    
    public function getAll()
    {
        $crawler = $this->client->request('GET', $this->app['config']['url.deputados']);
        $nodes = $crawler->filter('option');
        foreach($nodes as $node){
            print($node->nodeValue."\n");
            print($node->getAttribute('value')."\n\n");
        }
    }
    
    
    
}