<?php

class Error{

    private $module;
    
    function __construct($module){
        $this->module = $module;
    }
    public function addFailure($key, $error){
        if(!$_SESSION['errors'][$this->module]['failure'][$key])
            $_SESSION['errors'][$this->module]['failure'][$key] = $error;
    }
    public function copySuccessful($successful){
        $_SESSION['errors'][$this->module]['successful'] = $successful;
    }
    public function exists(){
        return (count($_SESSION['errors'][$this->module]['failure']) > 0);
    }
    public function noError($message){
        $_SESSION['errors'][$this->module]['noerror'] = $message;
    }
    public function getErrors(){
        return $_SESSION['errors'][$this->module]['failure'];
    }
    public function getSuccessful(){
        return $_SESSION['errors'][$this->module]['successful'];
    }
    public function getNoError(){
        return $_SESSION['errors'][$this->module]['noerror'];
    }
    function destruct(){
        unset($_SESSION['errors'][$this->module]);
    }
}
?>