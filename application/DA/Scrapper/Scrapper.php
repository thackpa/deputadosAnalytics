<?php

namespace DA\Scrapper;

use Goutte\Client;

class Scrapper
{
    
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }
    
}