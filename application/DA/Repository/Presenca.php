<?php

namespace DA\Repository;
use DA\Repository\Repository;

class Presenca extends Repository
{
    /**
     * campo onde serão salvas as presencas na DB
     * @var string
     */
    protected $dbField;

    public function __construct($app)
    {
        parent::__construct($app);
    }
    
    /**
     * armazena as Presencas no DB
     * @param  array  $presencas array de presencas a serem armazenadas
     * @return array            [description]
     */
    public function savePresencas(array $presencas)
    {
        $res = array();
        foreach ($presencas as $presenca) {
            $res[] = $this->getDb()->insert($this->dbField, $presenca);
        }
        
        return $res;
    }
    
}