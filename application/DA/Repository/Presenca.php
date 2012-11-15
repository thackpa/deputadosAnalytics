<?php

namespace DA\Repository;
use DA\Repository\Repository;

abstract class Presenca extends Repository
{
    /**
     * campo onde serão salvas as presencas na DB
     * @var string
     */
    protected $dbTable;

    public function __construct($app)
    {
        parent::__construct($app);
    }
    
    /**
     * Armazena as Presencas na DB
     * @param  array  $presencas array de presencas a serem armazenadas
     * @return array            [description]
     */
    public function savePresencas(array $presencas)
    {
        $res = array();
        foreach ($presencas as $presenca) {
            $res[] = $this->getDb()->insert($this->dbTable, $presenca);
        }
        
        return $res;
    }
    
}