<?php 

namespace DA\Util;

class Config extends \Pimple
{	
	public function __construct($configFile)
	{				
		$baseConfig = parse_ini_file($configFile,true);	
		$config = $this->setConfigInheritance($baseConfig);
		$this['config'] = $config[APPLICATION_ENV];		
	}

	protected function setConfigInheritance ( $baseConfig ) 
	{
		$config = array();
		
		array_walk($baseConfig, function($val,$key) use (&$config) { 

			$keys = explode(" : ", $key);
			$config[$keys[0]]  = $val;

			if(array_key_exists(1,$keys) && array_key_exists($keys[1], $config))
				$config[$keys[0]] = array_merge($config[$keys[1]],$config[$keys[0]]);
		});

		return $config;

	}
}