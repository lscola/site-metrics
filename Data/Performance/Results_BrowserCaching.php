<?php

	class Results_BrowserCaching {

		public $testPassed;

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			return $results;
		}

	}

?>
