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
    
    public function inserirNovosDeputados(array $deputados)
    {
        $res = array();
        foreach ($deputados as $deputado) {
            $res[] = $this->getDb()->insert('deputado', $deputado);
        }
        
        return $res;
    }
    
    
}
