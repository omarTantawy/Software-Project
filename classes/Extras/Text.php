<?php

/**
 * @author yehia
 * @copyright 2010
 */

class Text extends Input{


    static public function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }
    static public function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }
    static public function getSingular($plural){
        if(Text::endsWith($plural, 'ies')){
            return substr_replace($plural, 'y', strrpos($plural, 'ies'));
        }else if(Text::endsWith($plural, 's')){
            return substr_replace($plural, '', strrpos($plural, 's'));
        }else{
            return $plural;
        }
    }

    static function getPlural($singular){
        if(Text::endsWith($singular, 'y')){
            return substr_replace($singular, 'ies', strrpos($singular, 'y'));
        }else{
            return $singular.'s';
        }
    }

    static public function yousef($string, $length, $trailingLetters = ''){ 
	   return Text::limit($string, $length, $trailingLetters);
	}
    static public function limit($string, $length, $trailingLetters = ''){ 
	   if(strlen($string) <= $length) 
            return $string; 
	   else{ 
	       $text = explode(" ", $string);
	       $now = 0;
	       $ahmed = "";
    	   for($i=0; $i<count($text); $i++){ 
    	       $now += strlen($text[$i]); 
    	       if($now <= $length)     
                    $ahmed .= $text[$i] . " ";
	       } 
	       if($ahmed == $string) 
                return $ahmed ; 
	       else
                return $ahmed . $trailingLetters;
    	}
	}
    static public function safe($text){
    	return Database::real_escape_string($text);
    } 
    static public function getFirstLetter($text){
    	$c = strtolower(substr($text, 0, 1));
        if(preg_match('/[^a-z0-9]/i', $c)){
            $c = strtolower(substr($text, 1, 1));
            if(preg_match('/[^a-z]/i', $c)){
                $c = '-';
            }
        }else{
            if(preg_match('/[^a-z]/i', $c)){
                $c = '-';
            }
        }
        return $c;
    } 
	static public function getVariableName(&$iVar, &$aDefinedVars)
    {
	    foreach ($aDefinedVars as $k=>$v)
	        $aDefinedVars_0[$k] = $v;
	        
	    $iVarSave = $iVar;
	    $iVar     =!$iVar;
	    
	    $aDiffKeys = array_keys (array_diff_assoc ($aDefinedVars_0, $aDefinedVars));
	    $iVar      = $iVarSave;
	 
	    return $aDiffKeys[0];
    }
 
	public function lengthIsLessThan($max){
		if(strlen($this->value) < $max)
			return true;
		else
			return false;
	}
	public function lenghtIsLessThanOrEquals($max){
		if(strlen($this->value) <= $max)
			return true;
		else
			return false;
	}
	public function lengthIsMoreThan($min){
		if(strlen($this->value) > $min)
			return true;
		else
			return false;
	}
	public function lengthIsMoreThanOrEquals($min){
		if(strlen($this->value) >= $min)
			return true;
		else
			return false;
	}
	public function lengthIsBetween($min, $max){
		if(strlen($this->value) > $min && strlen($this->value) < $max)
			return true;
		else
			return false;
	}
	public function lengthIsBetweenOrEquals($min, $max){
		if(strlen($this->value) >= $min && strlen($this->value) <= $max)
			return true;
		else
			return false;
	}
	public function lengthIs($value){
		if(strlen($this->value) == $value)
			return true;
		else
			return false;
	}
	public function equals($value){
		if($this->value == $value)
			return true;
		else
			return false;
	}
}
?>