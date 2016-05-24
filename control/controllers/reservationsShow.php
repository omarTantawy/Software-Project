<?php
$this->title = 'Reservation';
$query =
    "select * from reservation , patient where reservation.patientId = patient.patientId and  reservationDate = '".date("Y-m-d")."'";
$select = new Select($query);
$select->prepare();
$total = $select->getTotal();
if ($select->getTotal() > 0) {

    $reservations = $select->getRecordSet();
} else {
    $noRecords = "No Reservation Today";
}
