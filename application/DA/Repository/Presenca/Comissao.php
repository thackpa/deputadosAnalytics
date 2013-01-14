<?php

namespace DA\Repository\Presenca;
use DA\Repository\Presenca;

class Comissao extends Presenca
{
    /**
     * campo onde serão salvas as presencas na DB 
     * @var string
     */
    protected $dbTable = 'presencacomissao';
         
}