<?php

$this->title = "Dependents";
$fetch = new Select(' select * from  dependent  ');
$fetch->prepare();
if ($fetch->getTotal() >= 1) {
    $dependents = $fetch->getRecordSet();
    $fetch2 = new Select(' select * from  patient  ');
    $fetch2->prepare();
    if ($fetch2->getTotal() >= 1) {
        $records = $fetch2->getRecordSet();

foreach($dependents as $dependent)
{
    foreach($records as $record)
    {   if($dependent['patientId']==$record['patientId'])
        {
         $_SESSION[$dependent['patientId']]=$record['name'];
        }
        }
}
}
    }
if($_GET['i'])
{
    require_once("patientDelete.php");
    $x=$_GET['i'];
    $result=Database::query("DELETE FROM dependent where dependentId= '".$x."'");

}
