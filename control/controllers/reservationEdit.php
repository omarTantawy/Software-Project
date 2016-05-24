<?php
$this->title = 'Reservation Edit';

$reservationId = $_GET['i'];


$select = new Select("SELECT * FROM reservation ");
$select->addCondition(" reservationId = " . $reservationId . " ");
$select->prepare();
$total = $select->getTotal();
if ($select->getTotal()) {
    $reservation = $select->getSingleRecord();


    $successMessage = '<div class="alert alert-success display">
                        <button class="close" data-close="alert"></button>
                       Reservation Edit Successfully
                    </div> ';

    if ($formSubmitted) {

        $update = new Update($reservationId , "reservationId" , $reservation , "reservationEdit" , " update reservation SET");
        $update->addText("reservationDate");
        $update->addText("reservationTime");
        $update->process($successMessage);
    }

} else {
    $noRecords = "Incorrect access Please don't do it again";
}
