<?php

namespace DA\Builder;

class Builder
{
    protected $app;
    
    public function __construct($app)
    {
        $this->app = $app;
    }
}