<?php
/*
+----------------------------------------------------------------------+
| Simple Perceptron by Leonardo Carmo                                  |
+----------------------------------------------------------------------+
| Copyright (c) 2017                                                   |
+----------------------------------------------------------------------+
| This class is being used to train a perceptron 	               |
| Essa classe está sendo usada para treinar um perceptron 	       |
+----------------------------------------------------------------------+
| Author: Leonardo Carmo <leonardo@hotmail.com>                        |
+----------------------------------------------------------------------+
*/

$resultExpected = [
[1,0,0,0],
[1,1,1,0]
];

$calc = [
[1,1],
[1,0],
[0,1],
[0,0]
];




class Perceptron {
	
	private $p1;
	private $p2;
	private $bi;
	private $resultExpected;
	private $calc;
	private $epoca = 0;
	
	
	function __construct($resultExpected, $calc){
		
		$this->resultExpected = $resultExpected;
		$this->calc = $calc;
		
		$this->setValues();

	}
	
	function setValues(){
		
		$this->p1 = $this->randomFloat();
		$this->p2 = $this->randomFloat();
		$this->bi = $this->randomFloat();

		$this->findResult();
		
	}
	
	function findResult(){
		
		$this->epoca++;
		$array = [];
		
		foreach ($this->calc as $key => $obj){
			
			$result = $obj[0] * $this->p1 + $obj[1] * $this->p2 + $this->bi;

			array_push($array, $this->checkValueMinMax($result));
			
		}
		
		$this->checkResult($array);
		
	}
	
	function checkResult($array){
		
		foreach ($this->resultExpected as $key => $obj){
			
			if ($array == $obj) {

				echo 'STAGE ['.$this->epoca.'] || P1['.$this->p1.'] || P2['.$this->p2.'] || BIAS['.$this->bi.'] RESULT['.implode(",", $obj).'] <br>';
				unset($this->resultExpected[$key]);

			}
			
		}
		
		if (empty($this->resultExpected)) {
					
			echo 'END';
					
	    } else {
			
			echo 'STAGE ['.$this->epoca.'] NOT FOUND <br>';	
			$this->setValues();
					
		}
		

	}

	
	
	
	
	
	// generate ramdom decimal
	function randomFloat($min = -1, $max = 1) {
		return round(($min + mt_rand() / mt_getrandmax() * ($max - $min)), 5);
	}
	
	function checkValueMinMax($value){
		
		if ($value <= 0) {
			return 0;
		} else {
			return 1;
		}
		
	}
	
}


$p = new Perceptron($resultExpected, $calc);


