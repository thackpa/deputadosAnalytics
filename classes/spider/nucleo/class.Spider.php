<?php
include_once(dirname(__FILE__).'/class.SpiderPool.php');

class Spider{
	private $ch;
	private $cookieFile;
	private $botName;
	private $timeout;
	private $maxRedirs;
	private $error;
	private $info;
	
	function __construct(){
		$this->ch		  = curl_init();
		$num 			  = mt_rand(10000,99999);
		$this->cookieFile = dirname(__FILE__) . "/cookie_{$_SERVER['REMOTE_ADDR']}_$num.txt";
		$this->botName 	  = "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.8) Gecko/20071022 Ubuntu/7.10 (gutsy) Firefox/3.0.0.8";
		$this->timeout 	  = 640;
		$this->maxRedirs  = 10;
	}
	
	function config($const,$value){
		//echo "curl_setopt(\$this->ch, $const, $value);";die;
		//eval("curl_setopt(\$this->ch, $const, \"$value\");");
		curl_setopt($this->ch, $const, $value);
	}
	
	function mainConfig(){
		//curl_setopt($this->ch,CURLOPT_COOKIEJAR,$this->cookieFile);
		//curl_setopt($this->ch,CURLOPT_HEADER,TRUE);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE,	   $this->cookieFile);
		curl_setopt($this->ch, CURLOPT_COOKIESESSION,  TRUE);
		curl_setopt($this->ch, CURLOPT_TIMEOUT,		   $this->timeout);
		curl_setopt($this->ch, CURLOPT_USERAGENT,	   $this->botName);
		curl_setopt($this->ch, CURLOPT_VERBOSE,		   FALSE);
		curl_setopt($this->ch, CURLOPT_MAXREDIRS,	   $this->maxRedirs);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
		//curl_setopt($this->ch, CURLOPT_PROXY, "10.8.0.251:3128");
	}
	
	function exec(){
		$this->mainConfig();
		if(($result = @curl_exec($this->ch)) === false){
			$this->set_error(curl_error($this->ch));
			return false;
		}
		else{
			$this->set_info(curl_getinfo($this->ch));
			return $result;
		}
	}
	
	function get($url, $referer = null){
		curl_setopt($this->ch, CURLOPT_URL, 	$url);
		curl_setopt($this->ch, CURLOPT_REFERER, $referer);            
		curl_setopt($this->ch, CURLOPT_HTTPGET, TRUE);
        curl_setopt($this->ch, CURLOPT_POST, 	FALSE);
        return $this->exec();
	}
	
	function getPrepare($url, $referer = null){
		curl_setopt($this->ch, CURLOPT_URL, 	$url);             
		curl_setopt($this->ch, CURLOPT_REFERER, $referer);
		curl_setopt($this->ch, CURLOPT_HTTPGET, TRUE);
        curl_setopt($this->ch, CURLOPT_POST, 	FALSE);
        $this->mainConfig();
	}
	
	function post($url,$referer = null,$data = array()){
		if(is_array($data)){
			$a = array();
			foreach ($data as $i => $v) 
				$a[] = "$i=".urlencode($v);
			$formData = join("&", $a);
		}
		else{
			$formData = $data;
		}
		curl_setopt($this->ch, CURLOPT_URL, 	   $url);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $formData);
        curl_setopt($this->ch, CURLOPT_POST,	   TRUE); 
        curl_setopt($this->ch, CURLOPT_HTTPGET,    FALSE);
        return $this->exec();
	}
	
	function postPrepare($url,$referer = null,$data = array()){
		if(is_array($data)){
			$a = array(); 
			foreach ($data as $i => $v) 
				$a[] = "$i=".urlencode($v);
			$formData = join("&",$a);
		}
		else{
			$formData = $data;
		}
		curl_setopt($this->ch, CURLOPT_URL, 	   $url);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $formData);
        curl_setopt($this->ch, CURLOPT_POST, 	   TRUE); 
        curl_setopt($this->ch, CURLOPT_HTTPGET,    FALSE);
        $this->mainConfig();
	}
	
	function getRequestInfo($opt = null){
		return (!$opt) ? curl_getinfo($this->ch) : curl_getinfo($this->ch, $opt);
	}
	
	function close(){
		curl_close($this->ch);
		//if(file_exists($this->cookieFile)) unlink($this->cookieFile);
	}
	
	### AUXILIAR FUNCIONS
	
	function cleanString($string){
		$string = preg_replace('/\n/',"",$string);
		$string = preg_replace('/\s{2,}/',"",$string);
		$string = preg_replace('/\t/',"",$string);
		return $string;
	}
	
	function saveToFile($string, $fileName = null){
		if(!$fileName) $fileName = dirname((__FILE__).'/debug.txt');

		$fp = @fopen($fileName,"w");
		if(!$fp){
			$this->set_error('Nao foi possivel abrir arquivo para escrita!');
			return false;
		}
		if(!fwrite($fp,$string,strlen($string))){
			$this->set_error('Nao foi possivel salvar arquivo!');
			return false;
		}
		fclose($fp);
		return true;
	}
	
	// ======== Metodos Get ==========	
	function get_ch(){
		return $this->ch;
	}
	
	function get_cookieFile(){
		return $this->cookieFile;
	}
	
	function get_botName(){
		return $this->botName;
	}
	
	function get_timeout(){
		return $this->timeout;
	}
	
	function get_maxRedirs(){
		return $this->maxRedirs;	
	}
	
	function get_error(){
		return $this->error;
	}
	
	function get_info(){
		return $this->info;
	}

	// ======== Metodos Set ==========
	function set_ch($ch){
		$this->ch = $ch;
	}
	
	function set_cookieFile($cf){
		$this->cookieFile = $cf;	
	}
		
	function set_botName($bn){
		$this->botName = $bn;
	}
		
	function set_timeout($t){
		$this->timeout = $t;
	}
		
	function set_maxRedirs($mr){
		$this->maxRedirs = $mr;
	}
		
	function set_error($e){
		$this->error = $e;
	}
	
	function set_info($i){
		$this->info = $i;
	}
}
?>