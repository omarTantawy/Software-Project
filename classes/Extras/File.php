<?php

/**
 * @author yehia
 * @copyright 2010
 */

class File{
	
	static public function copyAndConfirm($source, $destination){
		$result = copy($source, $destination);
		return ($result && is_file($destination));
	}
    static public function getExtension($name){
        return substr($name, strrpos($name, '.')+1);
    }
}

?>