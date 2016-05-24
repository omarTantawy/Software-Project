<?php
session_start();

ini_set('display_errors', 'On');
error_reporting(E_ALL^E_NOTICE);

date_default_timezone_set('Africa/Cairo');

function __autoload($class_name) {
    $class_file_path = '../classes/' . $class_name . '.php';
	if(file_exists($class_file_path))
		require_once $class_file_path;
	else{
		//throw new Exception('Class '.$class_name.' doesn\'t exist');
	}
}