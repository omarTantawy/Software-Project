<?php
$this->title = 'Home';



$reservationDate = date("Y-m-d");

$select = new Select("SELECT * FROM reservation WHERE reservationDate = '" . $reservationDate . "'");
$select->prepare();
$reserved = $select->getRecordSet();

