<?php
//If the user is registering 
if ($_POST['passwordRepeat'] && $_POST['usernameRegister'] && $_POST['passwordRegister']) {
    if ($_POST['passwordRegister'] == $_POST['passwordRepeat']) {
        $password = password_hash($_POST['passwordRegister'], PASSWORD_BCRYPT);
        $username_san = $vanidanitizator->sanitizeString($_POST['usernameRegister'], 'usernameRegister');
        if ($username_san && $vanidanitizator->validateString($username_san, 'usernameRegister')) {
            $databaseManager->addCharacter($username_san, $password);
            setcookie('connected', true);
            setcookie('username', $username_san);
            $_SESSION['connected'] = true;
        }
    }
}
//If the user is connecting
else if ($_POST['usernameLogin'] && $_POST['passwordLogin']){
    $username_san = $vanidanitizator->sanitizeString($_POST['usernameLogin'], 'usernameLogin');
        if ($username_san && $vanidanitizator->validateString($username_san, 'usernameLogin')) {
            if ($databaseManager->login($username_san, $_POST['passwordLogin'])) {
                setcookie('connected', true);
                setcookie('username', $username_san);
                $_SESSION['connected'] = true;
        }
    }
}
//If the user is disconnecting
if ($_POST['disconnect']) {
    $_SESSION['connected'] = false;
    setcookie('connected', false);
    setcookie('username', '');
}
if ($_COOKIE['connected']) {
    $_SESSION['connected'] = true;
}
?>