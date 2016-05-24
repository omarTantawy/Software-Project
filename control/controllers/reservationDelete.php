<?php
$this->title = 'Delete Reservations';
$id = (int)$_GET['i'];
Database::query("delete from reservation where reservationId = '".$id."'");
$formSubmitted = true;