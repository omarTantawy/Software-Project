<?php

/**
 * @author yehia
 * @copyright 2010
 */

class URL extends Input{
    static function urlize($url){
        return 
            strtolower(
            str_replace(',', '',
            str_replace('"', '',
            str_replace('”', '',
            str_replace('(', '',
            str_replace(')', '',
            str_replace('.', '',
            str_replace('#', '',
            str_replace(' ', '-', 
            str_replace("'", "",  
            str_replace("&", "and", 
            str_replace('&quot;', '',
            str_replace("_", "-", 
            str_replace("$", "s", 
            str_replace("ç", "c", 
            str_replace("ğ", "g", 
            str_replace("ü", "u", 
            str_replace("é", "e",
            str_replace("è", "e",
            str_replace("É", "e",
            str_replace("Ö", "o", 
            str_replace("ò", "o", 
            str_replace("ñ", "n",
            str_replace("?", "",
            str_replace("ó", "o", preg_replace('!\s+!', ' ', $url)
        )))))))))))))))))))))))));
    }
	public function isURL(){
		return (preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $this->value) == 0) ? false : true;
	}
}
?>