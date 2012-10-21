<?php

namespace DA\Builder;

class Presenca extends Builder
{

    private $presencaScrapper;
    private $presencaSessaoRepository;
    
    public function __construct($app, $scrapper = null, $repository = null)
    {
        parent::__construct($app);
        
        if(! $scrapper) {
            $this->presencaScrapper     = new \DA\Scrapper\Presenca($app);
        } else {
            $this->presencaScrapper     = $scrapper;
        }
        
        if(!$repository) {
            $this->presencaSessaoRepository   = new \DA\Repository\PresencaSessao($app);
        } else {
            $this->presencaSessaoRepository   = $repository;
        }
    }
    
    public function atualizarPresencasSessao()
    { 
        
    }
    
}