<?php
$this->title = 'My Reservation';


$select = new Select("
SELECT * FROM reservation
LEFT JOIN dependent ON reservation.dependentId = dependent.dependentId
WHERE reservation.patientId = " . $_SESSION['patient']['patientId'] . "
UNION
SELECT * FROM reservation
LEFT JOIN dependent ON reservation.dependentId = dependent.dependentId
WHERE reservation.patientId = " . $_SESSION['patient']['patientId'] . " ; ");

$select->prepare();
$total = $select->getTotal();
if ($select->getTotal() > 0) {

    $reservations = $select->getRecordSet();
} else {
    $noRecords = "No Order";
}
