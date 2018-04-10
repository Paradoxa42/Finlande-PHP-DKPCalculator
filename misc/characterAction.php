<?php 
    //If the user submitted an activity ID we add this activity to the activities a character did, its ID is got from GET method 
    if ($_POST['activity']) {
        $databaseManager->addCharacterActivity($_GET['id'], $_POST['activity']);
    }
?>