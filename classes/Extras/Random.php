<?php

/**
 * @author yehia
 * @copyright 2010
 */

abstract class Random{

    public static function alphanumeric($length = 16){
        $salt = "abchefghjkmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $codeit = '';
        while ($i < $length) {
            $num = rand() % 33;
            $tmp = substr($salt, $num, 1);
            $codeit = $codeit . $tmp;
            $i++;
        }
        return $codeit;
    }

    public static function lcalphanumeric($length = 16){
        $salt = "abchefghjkmnpqrstuvwxyz0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $codeit = '';
        while ($i < $length) {
            $num = rand() % 33;
            $tmp = substr($salt, $num, 1);
            $codeit = $codeit . $tmp;
            $i++;
        }
        return $codeit;
    }
    public static function numeric($length = 16){
        $salt = "0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $codeit = '';
        while ($i < $length) {
            $num = rand(0, 9);
            $tmp = substr($salt, $num, 1);
            $codeit = $codeit . $tmp;
            $i++;
        }
        return $codeit;
    }
}

?>