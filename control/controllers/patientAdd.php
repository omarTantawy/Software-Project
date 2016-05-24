<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 24/04/2016
 * Time: 10:04 م
 */
$this->title = 'PatientAdd';

if ($formSubmitted) {

    $insert = new Insert("patientAdd", "INSERT INTO patient");
    $insert->addText("name");
    $insert->addText("age");
    $insert->addText("userName");
    $insert->addText("password");
    $insert->addText("mobile");
    $insert->process();

}
