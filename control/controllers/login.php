<?php
$this->title = 'Login';
$successOnly = true;

$successMessage = '<div class="alert alert-success display">

                        <button class="close" data-close="alert"></button>
                       Login successfully
                    </div> ';

if ($formSubmitted) {

    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    $form = new Select(" select * from ".$type);

    $form->addCondition(" userName = '" . $userName . "'");
    $form->addCondition(" and password = '" . $password . "'");


    $form->prepare();

    if ($form->getTotal() == 1) {

        $record = $form->getSingleRecord();

        $_SESSION[$type] = $record;
        $_SESSION['errors']['login']['noerror'] = $successMessage;
        $_SESSION['user']=$type;
        $succes = new Error('default');
        $succes->noError($successMessage);
    } else {
        $_SESSION['errors']['login']['failure']['name'] = "Wrong email or Password";
    }
}
