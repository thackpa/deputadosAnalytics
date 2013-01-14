<?php

namespace DA\Repository\Presenca;
use DA\Repository\Presenca;

class Sessao extends Presenca
{
    /**
     * campo onde serão salvas as presencas na DB
     * @var string
     */
    protected $dbTable = 'presencasessao';  

}