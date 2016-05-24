<?php

$fetch = new Select("select * from patient");
$fetch->prepare();
$records = $fetch->getRecordSet();
?>
