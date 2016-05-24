<?php

/**
 * @author yehia
 * @copyright 2010
 */

abstract class Input {

	protected $value;
    
	public function __construct($value){
		$this->value = trim($value);
	}
	public function getValue(){
		return $this->value;
	}
}

?>