<?php

namespace DA\Builder;

use DA\Scrapper\Deputado;

class DeputadoData extends Builder
{

    public function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function atualizarListaDeputados()
    {
      $deputadosScrapper = new Deputado($this->app);
      $listaDep = $deputadosScrapper->getAll();
      
      $this->atualizarDeputados($listaDep);
    }
    
    public function atualizarDeputados(Array $listaDep)
    {
        $deputadosAtuais = $this->getDeputadosAtuais();
        $matriculasAtuais = $this->depToListaMatriculas($deputadosAtuais);
        array_walk($listaDep, function ($value,$key) use (&$matriculasNovas) { 
                                            $matriculasNovas[] = $value[0];});
        print_r($matriculasNovas);
    }
    
    public function getDeputadosAtuais()
    {
        $listaAtual = $this->getDb()->fetchAssoc("SELECT * FROM deputado");
        
        if(!$listaAtual)
            return array();
        else
            return $listaAtual;
    }
    
    public function depToListaMatriculas(Array $deputados)
    {
        array_walk($deputados,function ($deputado) use(&$matriculas){
                                        $matriculas[] = $deputado['matricula'];});
                                        
        return $matriculas;
    }
    
}