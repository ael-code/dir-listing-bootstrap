<?php


class ConfigProvider {
	private $decodedJson;
	
	function __construct(){
			$this->loadConfig();
	}	
	
	private function loadConfig(){
		//config.json should be in the same folder of this script
		$fileContent = file_get_contents("config.json");
		//strip comment like /*...*/ or //...
		$fileStripped = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $fileContent);
		$this->decodedJson = json_decode($fileStripped,true);
	}
	
	public function printConfig(){
		var_dump($this->decodedJson);
	}
	
	public function getCfg($key){
		return $this->decodedJson[$key];
	}
}

?>
