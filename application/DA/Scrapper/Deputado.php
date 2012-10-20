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
        $crawler = $this->request($this->app['config']['url.deputados']);
        $nodes   = $crawler->filter('#formDepAtual');
        
        $legislatura = $this->getLegislatura($nodes);   
        $deputados   = $this->getDeputadosData($nodes);
        
        return array(
            'legislatura' => $legislatura,
            'deputados' => $deputados
        );
    }
    
    private function getDeputadosData(\Symfony\Component\DomCrawler\Crawler $crawler)
    {
        $deps = array();
        $deps = $crawler->filter('#deputado > option')->each(function ($node, $i){
            $dep = array();
            if($i != 0) {
                $dados              = explode('|', $node->getAttribute('value'));
                $dep['nome']   = utf8_decode($dados[0]);
                $dados              = explode('%', $dados[1]);
                $dep['numero'] = $dados[0];
                $dados              = explode('!', $dados[1]);
                $dep['matricula'] = $dados[0];
                $dados              = explode('=', $dados[1]);
                $dep['estado'] = $dados[0];
                $dados              = explode('?', $dados[1]);
                $dep['partido']       = $dados[0];
                $dep['identificacao'] = $dados[1];
                return $dep;
            }
        });    
        array_shift($deps);
        return $deps;
    }
    
    private function getLegislatura(\Symfony\Component\DomCrawler\Crawler $crawler)
    {
        $legislatura = $crawler->filter('#leg')->first();
        return $legislatura->attr('value');
    }
    
}
