<?php
    //If the user submitted a name of activity, and an activity earning we add an activity to the database 
    if ($_POST['nameActivity'] && $_POST['earnActivity']) {
        $databaseManager->addActivity($_POST['nameActivity'], $_POST['earnActivity']);
    }
?>