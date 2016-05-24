<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 24/04/2016
 * Time: 10:04 م
 */
$this->title = 'SecretaryAdd';

if ($formSubmitted) {

    $insert = new Insert("secretaryAdd", "INSERT INTO secretary");
    $insert->addText("name");
    $insert->addText("userName");
    $insert->addText("password");
    $insert->addText("mobile");

    $insert->process();





}
