<?php

/**
 * @author yehia
 * @copyright 2010
 */

class Email extends Input{

	public function isEmail(){
		$filteredValue = filter_var($this->value, FILTER_VALIDATE_EMAIL);
		if($filteredValue === false)
			return false;
		else{
			$this->value = $filteredValue;
			return true;
		}
	}
	
	public function isAvailable($field, $table, $extraCondition = ''){
		$query = 'select ' . $field . ' from ' . $table . ' where ' . $field . ' = "'.$this->value.'" '.$extraCondition.'';
		$result = Database::query($query);
		return (mysql_num_rows($result) == 0);
	}
}
?>