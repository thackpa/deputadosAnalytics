<?php

namespace DA\Builder;

class Deputado extends Builder
{

    private $deputadoScrapper;
    private $deputadoRepository;
    
    public function __construct($app, $scrapper = null, $repository = null)
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
    }
    
    public function atualizarListaDeputados()
    {  
      $this->app['monolog']->addInfo("\n\n Iniciando a atualizacao de deputados!");  
        
      $deputadosOnline  = $this->deputadoScrapper->getAll();
      
      $this->app['monolog']->addInfo(sprintf("Recuperados %s deputados da página.", count($deputadosOnline)));
      
      $matriculasOnline = $this->getMatriculasFromArray($deputadosOnline);
      
      $deputadosBD      = $this->deputadoRepository->getDeputadosAtuais();
      $matriculasBD     = $this->getMatriculasFromArray($deputadosBD);
      
      $novasMatriculas  = array_diff($matriculasOnline, $matriculasBD);
      
      $novosDeputados   = $this->getNovosDeputados($deputadosOnline, $novasMatriculas);
      
      $this->app['monolog']->addInfo(sprintf("Diferenca de %s novos deputados.", count($novosDeputados)));
      
      $retorno = $this->deputadoRepository->inserirNovosDeputados($novosDeputados);
      
      $this->app['monolog']->addInfo(sprintf("Inseridos %s novos deputados.", count($retorno)));
    }
    
    #TODO: Otimizar esse método
    public function getNovosDeputados(array $deputados, array $matriculas)
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


    public function getMatriculasFromArray(array $deputados)
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