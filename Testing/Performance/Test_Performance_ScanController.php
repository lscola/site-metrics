<?php

  chdir("../../");
	require_once("Scan/Scan_Performance.php");

	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

	class Test_Performance_ScanController {

		private $header;
		private $source;
		private $dom;
		private $url;

		public function __construct($url){
			$this->url = $url;

			$this->header = "";
			$this->source = "";

			$this->getSource();
			$this->getDOM();

		}

		public function scan(){
      //echo $this->source;
      $scanPerformance = new Scan_Performance($this->dom, $this->url);
			return $scanPerformance->scan();
		}

		private function getSource(){
			// $srcText = tmpfile();
			$headerText = tmpfile();
			$curlHandle = curl_init();

			curl_setopt($curlHandle, CURLOPT_URL, $this->url);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curlHandle, CURLOPT_CERTINFO, 1);
			curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);
			curl_setopt($curlHandle, CURLOPT_STDERR, $headerText);
			//curl_setopt($curlHandle, CURLOPT_FILE, $srcText);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			$this->source = curl_exec($curlHandle);

			//Set $header to the verbose output returned by curl_exec
			fseek($headerText, 0);
			while(strlen($this->header .= fread($headerText, 8192)) == 8192);
			// $header now contains header information for the curl
			// operation that can be parsed to get size and load time
			curl_close($curlHandle);

		}

		private function getDOM(){
			$this->dom = new DOMDocument();
			libxml_use_internal_errors(true);
			$this->dom->loadHTML($this->source);
			libxml_use_internal_errors(false);

		}

		private function testDom(){
			$title = $this->dom->getElementsByTagName("title");
			echo "Title Tags: " . $title->length . "\n";

			// Prints inner html of title tag
			foreach($title as $tag){
				echo $tag->nodeValue . "\n";
			}
		}

	}

?>
