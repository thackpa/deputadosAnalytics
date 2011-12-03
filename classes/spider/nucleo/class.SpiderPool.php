<?
class SpiderPool {
	
	private $sessions;
	public  $error;
	
	function __construct($sessions = array()){
		$this->sessions = (is_array($sessions)) ? $sessions : array();
	}
	
	function addSpider(Spider $o){
		$this->sessions[] = $o;
	}
	
	function clear(){
		$this->sessions = array();
	}
	
	function exec(){
		$mh = curl_multi_init();
		foreach($this->sessions as $o){
			curl_multi_add_handle ($mh,$o->get_ch());
		}
		// start performing the request
		do{
			$mrc = curl_multi_exec($mh, $active);
		} while($mrc == CURLM_CALL_MULTI_PERFORM);

		while($active and $mrc == CURLM_OK){
			// wait for network
			$mrc = curl_multi_exec($mh, $active);
		  	if(curl_multi_select($mh) != -1){
		    	// pull in any new data, or at least handle timeouts
		    	do{
		      		$mrc = curl_multi_exec($mh, $active);
		    	} while($mrc == CURLM_CALL_MULTI_PERFORM);
		 	}
		}
		
		if($mrc != CURLM_OK){
  			$this->set_error("Curl multi read error $mrc\n");
  			return false;
		}
		
		$r = array();
		foreach($this->sessions as $i => $o){
  			if(($err = curl_error($o->get_ch())) == ''){
    			$r[$i] = curl_multi_getcontent($o->get_ch());
  			}
  			else{
    			$this->set_error("Curl error on handle $i: $err\n");
    			return false;
  			}
  			curl_multi_remove_handle($mh,$o->get_ch());
  			$o->close();
		}
		curl_multi_close($mh);
		return $r;
	}
	
	function get_error(){
		return $this->error;
	}

	function set_error($error){
		$this->error = $error;
	}
}
?>