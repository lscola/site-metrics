<?php

	class Results_SQLInjection {

		public $non_prepared_statements;
		public $prepared_statements;
		public $isLocal;

		public $testPassed;

		public function __construct(){
			$this->non_prepared_statements = 0;
			$this->prepared_statements = 0;
		}

		public function isUsingSQL(){
			if($non_prepared_statements > 0 || $prepared_statements > 0){
				$this->usingSQL = true;
			}
		}

		public function __toString(){
			$output = "";
			$output .= "\n--Scan: Security - SQL Injection--\n";
			if(!$this->isLocal){
				$output .= "Site is not local\n";
			}
			else {
				$output .= "Prepared Statements: $this->prepared_statements\n";
				$output .= "Non-Prepared Statements: $this->non_prepared_statements\n";
			}
			$output .= "Result: ";
			if($this->testPassed)
				$output .= "Pass\n";
			else
				$output .= "Fail\n";
			return $output;
		}

	}

?>
