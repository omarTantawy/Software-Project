<?php

$this->title = "Patients";
$fetch = new Select(' select * from  patient  ');
$fetch->prepare();
if ($fetch->getTotal() >= 1) {
    $patients = $fetch->getRecordSet();
} else {

    $noRecords = "No Patients exist In the system yet";
}

if($_GET['i'])
{
    require_once("patientDelete.php");
    $x=$_GET['i'];
    $result=Database::query("DELETE FROM patient where patientId= '".$x."'");

}
