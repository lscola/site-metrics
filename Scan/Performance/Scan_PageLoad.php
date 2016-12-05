<?php

	require_once("Data/Performance/Results_PageLoad.php");

	class Scan_PageLoad {

		private $dom;
		private $resultsPageLoad;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsPageLoad = new Results_PageLoad();
		}

		public function scan(){
			$this->resultsPageLoad->testPassed = $this->testPassed();
			return $this->resultsPageLoad;
		}

		public function testPassed(){
			return false;
		}

	}

?>
