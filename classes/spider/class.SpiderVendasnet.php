<?
require_once(dirname(__FILE__)."/nucleo/Spider.php");

class SpiderVendasnet extends Spider{
	private $aCampo;
	private $url;
	private $method;
	private $msg;
		
	function __construct(){
		parent::__construct();
	}
	
	// ===== Metodos Get =======
	function get_aCampo(){
		return $this->aCampo;
	}
	
	function get_url(){
		return $this->url;
	}

	function get_method(){
		return $this->method;
	}

	function get_msg(){
		return $this->msg;
	}
	
	// ===== Metodos Set =======
	function set_aCampo($aCampo){
		$this->aCampo = $aCampo;
	}
	
	function set_url($url){
		$this->url = $url;
	}
	
	function set_method($method){
		$this->method = $method;
	}

	function set_msg($msg){
		$this->msg = $msg;
	}
}
?>