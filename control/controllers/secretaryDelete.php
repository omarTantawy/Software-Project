<?php

$this->title = "Secretaries";
$fetch = new Select(' select * from  secretary  ');
$fetch->prepare();
if ($fetch->getTotal() >= 1) {
    $secretaries = $fetch->getRecordSet();
} else {

    $noRecords = "No Secretaries exist In the system yet";
}

if($_GET['i'])
{
    require_once("secretaryDelete.php");
    $x=$_GET['i'];
    $result=Database::query("DELETE FROM secretary where secretaryId= '".$x."'");

}
