<?php
    //If the user submitted a name of activity, and an activity earning we add an activity to the database 
    if ($_POST['nameActivity'] && $_POST['earnActivity']) {
        $databaseManager->addActivity($_POST['nameActivity'], $_POST['earnActivity']);
    }
    //If the user submit the deleteActivity with the ID of an activity we delete the activity from the database and all the associations with the characters
    if ($_POST['deleteActivity']) {
        $databaseManager->deleteActivity($_POST['deleteActivity']);
    }
?>