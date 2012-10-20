<?php

namespace DA\Repository;

class Deputado extends Repository
{
    
    public function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function getDeputadosAtuais()
    {
        $listaAtual = $this->getDb()->fetchAll("SELECT * FROM deputado");
        
        if(!$listaAtual)
            return array();
        else
            return $listaAtual;
    }
    
    public function inserirNovosDeputados()
    {

    }
    
    
}
