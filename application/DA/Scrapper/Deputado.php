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
    
    
    /**
     * @desc Pega todos os Deputados que estão listados no combo box da url que está na configuração.
     * @return array array( array('matricula' => number $matricula, 'nome' => String $nome), ...) 
     */
    public function getAll()
    {
        $deputados = array();
        
        $crawler = $this->request($this->app['config']['url.deputados']);
        
        
        $nodes = $crawler->filter('option');
        foreach($nodes as $node){
            $dados = explode('!', $node->getAttribute('value'));
            
            if(count($dados) == 2)
                $deputados[] = array('matricula' => $dados[1], 'nome' => $dados[0]);
        }
        return $deputados;
    }
    
}
