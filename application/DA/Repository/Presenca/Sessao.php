<?php

namespace DA\Repository\Presenca;
use DA\Repository\Repository;

class Sessao extends Repository
{
    
    public function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function savePresencas(array $presencas)
    {
        $res = array();
        foreach ($presencas as $presenca) {
            $res[] = $this->getDb()->insert('presencasessao', $presenca);
        }
        
        return $res;
    }
    
}