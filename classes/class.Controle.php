<?php
require_once(dirname(__FILE__)."/spider/nucleo/class.Spider.php");

class Controle {
	private $msg;

	function __construct(){
		
	}
	
	/**
	 * Instancia a classe Spider
	 * 
	 * @return Spider
	 */
	function get_spider(){
		$oSpider = new Spider();
		return $oSpider;
	}

	function get_msg(){
		return $this->msg;
	}
	
	function set_msg($msg){
		$this->msg = $msg;
	}
	
	function get_conexao(){
		return $this->conexao;
	}
	
	function fecharConexao(){
		$conexao = new Conexao();
		return $conexao->close();
	}
}
?>