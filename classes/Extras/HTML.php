<?php

/**
 * @author yehia
 * @copyright 2010
 */

class HTML extends Input{

	public function withoutTags(){
		return filter_var($this->value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	}
	public function removeTags(){
		$this->value = $this->withoutTags();
	}
	public function hasTags(){
		return ($this->withoutTags() != $this->value);
	}
	public function withEntities(){
		return filter_var($this->value, FILTER_SANITIZE_SPECIAL_CHARS);
	}
	public function useEntities(){
		$this->value = $this->withEntities();
	}
}
?>