<?php
//If the user is registering 
if ($_POST['passwordRepeat'] && $_POST['usernameRegister'] && $_POST['passwordRegister']) {
    echo $_POST['usernameRegister'] ." ".$_POST['passwordRegister']. " ".$_POST['passwordRepeat'];
    if ($_POST['passwordRegister'] == $_POST['passwordRepeat']) {
        $password = password_hash($_POST['passwordRegister'], PASSWORD_BCRYPT);
        $databaseManager->addCharacter($_POST['usernameRegister'], $password);
        setcookie('connected', true);
    }
}
//If the user is connecting
else if ($_POST['usernameLogin'] && $_POST['passwordLogin']){
    echo $_POST['usernameLogin'] ." ".$_POST['passwordLogin'];
    if ($databaseManager->login($_POST['usernameLogin'], $_POST['passwordLogin'])) {
        setcookie('connected', true);
    }
}
else if ($_POST['disconnect']) {
    $_COOKIE['connected'] = false;
}
?>