<?php

/**
 * @author yehia
 * @copyright 2010
 */

class Float extends Input{

	public function isFloat(){
		$filteredValue = filter_var($this->value, FILTER_VALIDATE_FLOAT);
		if($filteredValue === false)
			return false;
		else{
			$this->value = $filteredValue;
			return true;
		}
	}
	public function isMoreThan($value){
		return ($this->isFloat() && $this->value>$value);
	}
	public function isMoreThanOrEquals($value){
		return ($this->isFloat() && $this->value >= $value);
	}
	public function isLessThan($value){
		return ($this->isFloat() && $this->value < $value);
	}
	public function isLessThanOrEquals($value){
		return ($this->isFloat() && $this->value <= $value);
	}
	public function isBetween($min, $max){
		return ($this->isFloat() && $this->value > $min && $this->value < $max);
	}
	public function isBetweenEquals($min, $max){
		return ($this->isFloat() && $this->value >= $min && $this->value <= $max);
	}
	public function equals($value){
		return ($this->isFloat() && $this->value == $value);
	}
}
?>