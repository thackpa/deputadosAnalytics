<?php

namespace DA\Builder;

class Presenca extends Builder
{

    private $presencaScrapper;
    private $presencaSessaoRepository;
    private $legislaturaRepository;
    private $deputadoRepository;
    
    public function __construct($app, $scrapper = null, $repository = null, $legislaturaRepository = null, $deputadoRepository = null)
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
    
    public function atualizarPresencasSessao($mes = null)
    { 
        if(is_null($mes)) {
            $mes = date("m");
        }
        
        $datas = $this->getDatas4Extracao($mes);
        
        $legislatura = $this->legislaturaRepository->getLegislaturaAtual();
        
        $deputados = $this->deputadoRepository->getDeputadosAtuais();
        
        foreach ($deputados as $deputado) {
            
            $this->app['monolog']->addInfo(sprintf("Iniciando a extracao para o deputado %s.", $deputado['nome']));
            
            $presencas = $this->presencaScrapper->getPresencas($deputado['id'], $legislatura['numero'], substr($deputado['matricula'], -3), $datas['dataInicio'], $datas['dataFim']);
            
            $this->app['monolog']->addInfo(sprintf("Recuperado %s presencas para o deputado %s.", count($presencas), $deputado['nome']));
            
            $retorno = $this->presencaSessaoRepository->savePresencas($presencas);
            
            $this->app['monolog']->addInfo(sprintf("Salvo %s presencas.", count($retorno)));
        }
        
    }
    
    private function getDatas4Extracao($mes)
    {
        $endDay = 31;

        if($mes == 2) {
            $endDay = 28;
        }elseif($mes % 2 == 0) {
            $endDay = 30;
        }

        $ano = date('Y');
        $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
        
        return array("dataInicio" => "01/$mes/$ano", "dataFim" => "$endDay/$mes/$ano");
    }
    
}