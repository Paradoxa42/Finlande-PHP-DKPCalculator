<?php
//If the user is registering 
if ($_POST['passwordRepeat'] && $_POST['usernameRegister'] && $_POST['passwordRegister']) {
    if ($_POST['passwordRegister'] == $_POST['passwordRepeat']) {
        $password = password_hash($_POST['passwordRegister'], PASSWORD_BCRYPT);
        $databaseManager->addCharacter($_POST['usernameRegister'], $password);
        //setcookie('connected', true);
        $_SESSION['connected'] = true;
    }
}
//If the user is connecting
else if ($_POST['usernameLogin'] && $_POST['passwordLogin']){
    if ($databaseManager->login($_POST['usernameLogin'], $_POST['passwordLogin'])) {
        //setcookie('connected', true);
        $_SESSION['connected'] = true;
    }
}
//If the user is disconnecting
if ($_POST['disconnect']) {
    $_SESSION['connected'] = false;
}
?>