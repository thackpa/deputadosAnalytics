<?php

namespace DA\Scrapper;
use DA\Scrapper\Scrapper;

abstract class Presenca extends Scrapper
{
    protected $app;
    
    public function __construct($app)
    {
        $this->app = $app;
        parent::__construct();
    }
    
}