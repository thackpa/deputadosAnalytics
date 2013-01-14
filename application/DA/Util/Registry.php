<?php

namespace DA\Util;

class Registry extends \ArrayObject
{
    
    private static $_registry = null;
    
    public static function getInstance()
    {
        if (self::$_registry === null) {
            self::$_registry = new Registry();
        }

        return self::$_registry;
    }
    
    public static function get($index)
    {
        $instance = self::getInstance();

        if (!$instance->offsetExists($index)) {
            throw new \Exception("No entry is registered for key '$index'");
        }

        return $instance->offsetGet($index);
    }
    
    public static function set($index, $value)
    {
        $instance = self::getInstance();
        $instance->offsetSet($index, $value);
    }
    
    public function offsetExists($index)
    {
        return array_key_exists($index, $this);
    }
    
    public function __construct($array = array(), $flags = parent::ARRAY_AS_PROPS)
    {
        parent::__construct($array, $flags);
    }
    
}