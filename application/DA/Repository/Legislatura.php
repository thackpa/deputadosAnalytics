<?php

namespace DA\Repository;

class Legislatura extends Repository
{
    
    public function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function atualizarLegislaturaAtual($legislatura)
    {
        $query = 'UPDATE legislatura SET numero = ? WHERE atual = 1';
        return $this->getDb()->executeUpdate($query, array($legislatura));
    }
    
    public function getLegislaturaAtual()
    {
        $legislaturaAtual = $this->getDb()->fetchAssoc("SELECT * FROM legislatura WHERE atual = 1");
        
        if(!$legislaturaAtual)
            return array();
        else
            return $legislaturaAtual;
    }
    
}