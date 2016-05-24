<?php
$this->title = 'Reservation Time';


$reservationDate = $_GET['date'];

$select = new Select("SELECT * FROM reservation WHERE reservationDate = '" . $reservationDate . "'");
$select->prepare();
$reserved = $select->getRecordSet();


if ($formSubmitted) {

    $successMessage = '<div class="alert alert-success display">

                        <button class="close" data-close="alert"></button>
                       Reservation Added Successfully
                    </div> ';

    $patientId = $_SESSION['patient']['patientId'];


    $insert = new Insert("reservationTime", "INSERT INTO reservation");
    $insert->addinfo("patientId", $patientId);
    $insert->addinfo("reservationDate", $reservationDate);
    $insert->addNumber("reservationTime");
    $insert->process($successMessage);

}

