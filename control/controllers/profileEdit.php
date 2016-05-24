<SCRIPT TYPE="text/javascript" SRC="verifynotify.js"></SCRIPT>
<?php

$this->title = 'Edit';
$successOnly = true;

$successMessage = '<div class="alert alert-success display">

                        <button class="close" data-close="alert"></button>
                       Edit profile successfully
                    </div> ';

$type = $_SESSION['user'];

$form= new Select("select * from ".$type);
$form->addCondition($type."Id=".$_SESSION[$type][$type.'Id']);
$form->prepare();
if ($form->getTotal() == 1)
    $record = $form->getSingleRecord();

if ($formSubmitted) {

    $update = new Update($record[$type.'Id'],$type."Id",$record, "profileEdit", "UPDATE $type SET ");
    $update->addText("name");
    $update->addText("userName");
    $update->addText("password");
    $update->addText("mobile");
    if($type!="secretary")
    $update->addText("address");
    $update->process($successMessage);


}



