<?php

class FormProcessor{

    protected $successful = array();
    protected $successfulProcessed = array();
    protected $error;
    
    public static function queryStringWithout($var){
        $pairs = @explode('&', $_SERVER['QUERY_STRING']);
        if($pairs){
            foreach($pairs as $pair){
                $namevalue = explode('=', $pair);
                if($namevalue[0] != $var)
                    $newQS[] = $pair;
            }
        }
        return @implode('&', $newQS);
    }
    
    public function __construct($module){
        $this->error = new Error($module);
    }
    private function accept($key){
        if(!$this->successful[$key]){
            $this->successful[$key] = stripslashes($_POST[$key]);
            $this->successfulProcessed[$key] = $_POST[$key];
        }
    }
    protected function columnsToInsert(){
        $keys = array();
        $vals = array();
        foreach($this->successfulProcessed as $key => $val){
            $keys[] = $key;
            $vals[] = $val;
        }
        $columns = implode(', ',$keys);
        $values = '"'.implode('", "', $vals).'"';
        return '('.$columns.') value ('.$values.')';
    }
    protected function columnsToUpdate(){
        $keys = array();
        foreach($this->successfulProcessed as $key => $val){
            $keys[] = $key.' = "'.$val.'"';
        }
        return implode(', ',$keys);
    }
   public function generatePassword($length = 6) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
    public function addText($key, $error = null, $min = 1, $max = null){
    	$cleanText = trim(strip_tags($_POST[$key]));
        if($error){
            $text = new Text($cleanText);
            if($text->lengthIsLessThan($min) || ($max != null && $text->lengthIsMoreThan($max))){
                $this->error->addFailure($key, $error);
                return;
            }
        }
        $this->accept($key);
        $this->successfulProcessed[$key] = $cleanText;
    }

    public function addinfo($key, $info ,  $error = null, $min = 1, $max = null){
        $cleanText = trim(strip_tags($info));
        if($error){
            $text = new Text($cleanText);
            if($text->lengthIsLessThan($min) || ($max != null && $text->lengthIsMoreThan($max))){
                $this->error->addFailure($key, $error);
                return;
            }
        }
        $this->accept($key);
        $this->successfulProcessed[$key] = $cleanText;
    }

	public function addError($key , $error){
                $this->error->addFailure($key, $error);
    }
	
    public function addDifferentFromOrDifferentFrom($key, $value, $key2, $value2, $error){
    	$cleanText = Database::real_escape_string(trim(strip_tags(stripslashes($_POST[$key]))));
    	$cleanText2 = Database::real_escape_string(trim(strip_tags(stripslashes($_POST[$key2]))));
        
        $value = Database::real_escape_string(trim(strip_tags(stripslashes($value))));
        $value2 = Database::real_escape_string(trim(strip_tags(stripslashes($value2))));
        
        if($cleanText == $value && $cleanText2 == $value2){
            $this->error->addFailure($key, $error);
            return;
        }else{
            $this->accept($key);
            $this->successfulProcessed[$key] = trim(strip_tags($_POST[$key]));

            $this->accept($key2);
            $this->successfulProcessed[$key2] = trim(strip_tags($_POST[$key2]));
        }
    }
    public function addHTML($key, $error = null, $min = 1, $max = null){
        if($error){
            $text = new Text($_POST[$key]);
            if($text->lengthIsLessThan($min) || ($max != null && $text->lengthIsMoreThan($max))){
                $this->error->addFailure($key, $error);
                return;
            }
        }
        $this->accept($key);
        $this->successfulProcessed[$key] = trim($_POST[$key]);
    }
    public function addEmail($key, $error){
        $text = new Email($_POST[$key]);
        if(!$text->isEmail()){
            $this->error->addFailure($key, $error);
        }else{
            $this->accept($key);
            $this->successfulProcessed[$key] = trim($_POST[$key]);
        }
    }
    public function availableEmail($key, $error){
        $text = new Email($_POST[$key]);
        if(!$this->emailIsAvailable($text)){
            $this->error->addFailure($key, $error);
        }else{
            $this->accept($key);
            $this->successfulProcessed[$key] = trim($_POST[$key]);
        }
    }
    public function addURL($key, $error){
        $text = new URL($_POST[$key]);
        if(!$text->isURL()){
            $this->error->addFailure($key, $error);
        }else{
            $this->accept($key);
            $this->successfulProcessed[$key] = trim($_POST[$key]);
        }
    }
    public function addAvailable($key, $error){
        if(!$this->isAvailable($key)){
            $this->error->addFailure($key, $error);
        }else{
            //$this->accept($key);
            //$this->successfulProcessed[$key] = trim($_POST[$key]);
        }
    }
	public function addAvailable_array($key, $error){
        if(!$this->isAvailable_array($key)){
            $this->error->addFailure($key[0], $error);
        }else{
            //$this->accept($key);
            //$this->successfulProcessed[$key] = trim($_POST[$key]);
        }
    }
	public function checkAvailable($key){
        if(!$this->isAvailable($key)){
            return false;
        }else{
			return true;
        }
    }
    public function addNumber($key, $error = null, $min = null){
        if($error){
            $text = new Float($_POST[$key]);
            if(!$text->isFloat() || ($min != null && $text->isLessThan($min))){
                $this->error->addFailure($key, $error);
                return;
            }
        }
        $this->accept($key);
        $this->successfulProcessed[$key] = trim($_POST[$key]);
    }
    public function addCaptcha($key, $error){
        if($_SESSION['captcha'][$_POST[$key]] != $_POST[$key] || !$_POST[$key]){
            $this->error->addFailure($key, $error);
        }
        unset($_SESSION[$text]);
    }
    public function addEquals($key, $value, $error){
        $text = new Text($_POST[$key]);
        if(!$text->equals($value)){
            $this->error->addFailure($key, $error);
        }else{
            $this->accept($key);
        }
    }
    public function addConfirm($key, $key2, $error){
        $text = new Text($_POST[$key]);
        if(!$text->equals($_POST[$key2])){
            $this->error->addFailure($key2, $error);
        }else{
            $this->accept($key2);
            $this->successfulProcessed[$key2] = trim($_POST[$key2]);
        }
    }
    public function addDate($key, $error){
        $date = new Date($_POST[$key]);
        if(!$date->isDayMonthYear()){
            $this->error->addFailure($key, $error);
        }else{
            $this->accept($key);
            $this->successfulProcessed[$key] = $date->getTimestamp();
        }
    }
    public function addImage($key, $folder, $error = null){
        if($_FILES[$key]['tmp_name']){
            $file = $_FILES[$key]['tmp_name'];
        }else{
            $file = $_POST[$key];
        }
        $image = new Image($file);
        $imageName = Random::alphanumeric().'.'.$image->getExtension();
        $save = $image->saveOriginal($folder.'/'.$imageName);
        if($error){
            if(!$save){
                $this->error->addFailure($key, $error);
                return;
            }
        }
        if($save){
            $this->accept($key);
            $this->successfulProcessed[$key] = $imageName;
        }
    }
    public function addUpload($key, $folder, $error = null){
        $file = $_FILES[$key]['tmp_name'];
        $fileName = Random::alphanumeric().'.'.File::getExtension($_FILES[$key]['name']);
        $save = File::copyAndConfirm($file, $folder.'/'.$fileName);
        if($error){
            if(!$save){
                $this->error->addFailure($key, $error);
                return;
            }
        }
        if($save){
            $this->accept($key);
            $this->successfulProcessed[$key] = $fileName;
        }
    }
    public function addImageAndThumbnail($key, $folder, $error = null){
        if($_FILES[$key]['tmp_name']){
            $file = $_FILES[$key]['tmp_name'];
        }else{
            $file = $_POST[$key];
        }
        $image = new Image($file);
        $random = Random::alphanumeric();
        $imageName = $random.'.'.$image->getExtension();
        $save = $image->saveOriginal($folder.'/'.$imageName);
        $saveThumbnail = $this->createThumbnail($image, $random, $folder);
        if($error){
            if(!$save || !$saveThumbnail){
                $this->error->addFailure($key, $error);
                return;
            }
        }
        if($save && $saveThumbnail){
            $this->accept($key);
            $this->successfulProcessed[$key] = $imageName;
        }
    }
    public function addImploded($key, $glue, $error = null){
        if($error){
            if(!$_POST[$key]){
                $this->error->addFailure($key, $error);
                return;
            }
        }
        $this->accept($key);
        if($_POST[$key]){
            foreach($_POST[$key] as $val){
                if($val)
                    $passed[] = $val;
            }
        }
        $this->successfulProcessed[$key] = trim(@implode($glue, $passed));
    }
    public function addPredefined($key, $value){
        $_POST[$key] = $value;
        $this->accept($key);
    }
    public function addArray($key){
        $this->accept($key);
    }
    public function process($noErrorMessage){
        if($this->error->exists()){
            $this->error->copySuccessful($this->successful);
        }else{
            foreach($this->successfulProcessed as $key => $val){
                $this->successfulProcessed[$key] = Database::real_escape_string(stripslashes(str_replace('&quot;', '"', $val)));
            }
            $this->excuteQuery();
            $this->error->noError($noErrorMessage);
        }
    }
	public function get_last( $column , $table ){
		 $result = Database::query(' SELECT * FROM '.$table.' ORDER BY '.$column.' DESC ');

		 foreach ($result as $res){
            return $res['lecture_id'];
        }
		
	}
}