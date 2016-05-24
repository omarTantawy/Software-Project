<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 24/04/2016
 * Time: 10:04 م
 */

$form = new Select("select * from patient");

$form->prepare();
if ($form->getTotal() >= 1)
    $patients = $form->getRecordSet();
$this->title = 'DependentAdd';

if ($formSubmitted) {

    $insert = new Insert("dependentAdd", "INSERT INTO dependent");
    $insert->addText("name");
    $insert->addText("patientId");
    $insert->addText("userName");
    $insert->addText("password");
    $insert->addText("mobile");
    $insert->process();

}
