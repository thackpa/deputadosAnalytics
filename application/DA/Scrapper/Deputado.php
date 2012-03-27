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
        $deputados = array();
        $crawler = $this->request($this->app['config']['url.deputados']);
        $nodes = $crawler->filter('option');
        foreach($nodes as $node){
            $dados = explode("!", $node->getAttribute('value'));
            
            if(count($dados) == 2)
                $deputados[] = array($dados[1],$dados[0]);
        }
        return $deputados;
    }
    
}
