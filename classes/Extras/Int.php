<?php

/**
 * @author yehia
 * @copyright 2010
 */

class Int extends Input{

	public function isInt(){
		$filteredValue = filter_var($this->value, FILTER_VALIDATE_INT);
		if($filteredValue === false)
			return false;
		else{
			$this->value = $filteredValue;
			return true;
		}
	}
	public function isMoreThan($value){
		if($this->isInt()){
			$options= array();
			$options['options']['min_range'] = $value+1;
			$filteredValue = filter_var($this->value, FILTER_VALIDATE_INT, $options);
			if($filteredValue === false)
				return false;
			else{
				$this->value = $filteredValue;
				return true;
			}
		}else
	 		return false;
	}
	public function isMoreThanOrEquals($value){
		$options= array();
		$options['options']['min_range'] = $value;
		$filteredValue = filter_var($this->value, FILTER_VALIDATE_INT, $options);
		if($filteredValue === false)
			return false;
		else{
			$this->value = $filteredValue;
			return true;
		}
	}
	public function isLessThan($value){
		if($this->isInt()){
			$options= array();
			$options['options']['max_range'] = $value-1;
			$filteredValue = filter_var($this->value, FILTER_VALIDATE_INT, $options);
			if($filteredValue === false)
				return false;
			else{
				$this->value = $filteredValue;
				return true;
			}
		}else
			return false;
	}
	public function isLessThanOrEquals($value){
		$options= array();
		$options['options']['max_range'] = $value;
		$filteredValue = filter_var($this->value, FILTER_VALIDATE_INT, $options);
		if($filteredValue === false)
			return false;
		else{
			$this->value = $filteredValue;
			return true;
		}
	}
	public function isBetween($min, $max){
		$options = array();
		$options['options']['min_range'] = $min+1;
		$options['options']['max_range'] = $max-1;
		$filteredValue = filter_var($this->value, FILTER_VALIDATE_INT, $options);
		if($filteredValue === false)
			return false;
		else{
			$this->value = $filteredValue;
			return true;
		}
	}
	public function isBetweenOrEquals($min, $max){
		$options = array();
		$options['options']['min_range'] = $min;
		$options['options']['max_range'] = $max;
		$filteredValue = filter_var($this->value, FILTER_VALIDATE_INT, $options);
		if($filteredValue === false)
			return false;
		else{
			$this->value = $filteredValue;
			return true;
		}
	}
	public function equals($value){
		return ($this->isInt() && $this->value == $value);
	}
}
?>