<?php
    //If the user submitted a name of activity, and an activity earning we add an activity to the database 
    if ($_POST['nameActivity'] && $_POST['earnActivity']) {
        //First we sanitize the inputs
        $name_activity_san = $vanidanitizator->sanitizeString($_POST['nameActivity']);
        $earn_san = $vanidanitizator->sanitizeNumber(intval($_POST['earnActivity']));
        //Then we check if the sanitization went well and if the inputs are valid
        if ($name_activity_san && $earn_san && $vanidanitizator->validateNumber($earn_san) && $vanidanitizator->validateString($name_activity_san)) {
            $databaseManager->addActivity($name_activity_san, $earn_san);
        }
    }
    //If the user submit the deleteActivity with the ID of an activity we delete the activity from the database and all the associations with the characters
    if ($_POST['deleteActivity']) {
        //First we sanitize the inputs
        $earn_san = $vanidanitizator->sanitizeNumber(intval($_POST['deleteActivity']));
        //Then we check if the sanitization went well and if the inputs are valid
        if ($earn_san && $vanidanitizator->validateNumber(intval($earn_san)))
            $databaseManager->deleteActivity($earn_san);
    }
?>