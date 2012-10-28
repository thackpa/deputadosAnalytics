<?php

namespace DA\Builder\Presenca;
use DA\Builder\Presenca;

class Comissao extends Presenca
{    
    
    /**
     * Inicializa as principais variaveis para realização da exração e armazenamento no BD
     * @param Silex\Application $app                   
     * @param \DA\Scrapper $scrapper              
     * @param \DA\Repository $repository            
     * @param \DA\Repository $legislaturaRepository 
     * @param \DA\Repository $deputadoRepository    
     */
    public function __construct($app, $scrapper = null, $repository = null, $legislaturaRepository = null, $deputadoRepository = null)
    {
        parent::__construct($app);
        
        if(! $scrapper) {
            $this->presencaScrapper     = new \DA\Scrapper\Presenca\Comissao($app);
        } else {
            $this->presencaScrapper     = $scrapper;
        }
        
        if(!$repository) {
            $this->presencaRepository   = new \DA\Repository\Presenca\Comissao($app);
        } else {
            $this->presencaRepository   = $repository;
        }
        
        if(!$legislaturaRepository) {
            $this->legislaturaRepository   = new \DA\Repository\Legislatura($app);
        } else {
            $this->legislaturaRepository   = $legislaturaRepository;
        }
        
        if(!$deputadoRepository) {
            $this->deputadoRepository   = new \DA\Repository\Deputado($app);
        } else {
            $this->deputadoRepository   = $deputadoRepository;
        }
    }
    
}