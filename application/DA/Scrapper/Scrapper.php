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
    

    public function getClient()
    {
        return $this->client;
    }
    
    public function request($url)
    {
        return $this->getClient()->request('GET', $url);
    }
}
