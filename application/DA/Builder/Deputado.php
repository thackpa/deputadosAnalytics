<?php

namespace DA\Builder;

class Deputado extends Builder
{

    private $deputadoScrapper;
    private $deputadoRepository;
    private $legislaturaRepository;
    
    public function __construct($app, $scrapper = null, $repository = null, $legislaturaRepo = null)
    {
        parent::__construct($app);
        
        if(! $scrapper) {
            $this->deputadoScrapper     = new \DA\Scrapper\Deputado($app);
        } else {
            $this->deputadoScrapper     = $scrapper;
        }
        
        if(!$repository) {
            $this->deputadoRepository   = new \DA\Repository\Deputado($app);
        } else {
            $this->deputadoRepository   = $repository;
        }
        
        if(is_null($legislaturaRepo)) {
            $this->legislaturaRepository   = new \DA\Repository\Legislatura($app);
        } else {
            $this->legislaturaRepository   = $legislaturaRepo;
        }
    }
    
    #refatorar - muito grande e 4 responsabilidades
    public function atualizarListaDeputados()
    {  
      $this->app['monolog']->addInfo("\n\n Iniciando a atualizacao de deputados!");  
        
      $info = $this->deputadoScrapper->getMainInfo();
      
      $this->app['monolog']->addInfo(sprintf("Recuperados %s deputados da página 
          para a legislatura %s.", count($info['deputados']), 
              $info['legislatura']));
      
      $retorno = $this->legislaturaRepository->atualizarLegislaturaAtual($info['legislatura']);
      
      $matriculasOnline = $this->getMatriculasFromArray($info['deputados']);
      
      $deputadosBD      = $this->deputadoRepository->getDeputadosAtuais();
      $matriculasBD     = $this->getMatriculasFromArray($deputadosBD);
      
      $novasMatriculas  = array_diff($matriculasOnline, $matriculasBD);
      
      $novosDeputados   = $this->getNovosDeputados($info['deputados'], $novasMatriculas);
      
      $this->app['monolog']->addInfo(sprintf("Diferenca de %s novos deputados.", count($novosDeputados)));
      
      $retorno = $this->deputadoRepository->inserirNovosDeputados($novosDeputados);
      
      $this->app['monolog']->addInfo(sprintf("Inseridos %s novos deputados.", count($retorno)));
    }
    
    #TODO: Otimizar esse método
    private function getNovosDeputados(array $deputados, array $matriculas)
    {
        $novos = array();
        foreach ($deputados as $deputado){
            if($matriculas)
                foreach ($matriculas as $matricula){
                    if($matricula == $deputado['matricula']){
                        $novos[] = $deputado;
                    }
                }
        }
        
        return $novos;
    }


    private function getMatriculasFromArray(array $deputados)
    {
        $matriculas = array();
        array_walk($deputados, 
                function ($deputado) use (&$matriculas) { 
                    $matriculas[] = $deputado['matricula'];
                }
        );
        
        return $matriculas;
    }
    
}