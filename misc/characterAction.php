<?php 
    //If the user submitted an activity ID we add this activity to the activities a character did, its ID is got from GET method 
    if ($_POST['activity']) {
        $databaseManager->addCharacterActivity($_GET['id'], $_POST['activity']);
    }
    
    //If the user submit the deleteActivityCharacter with the ID of an activity we delete the activity from the database
    if ($_POST['deleteActivityCharacter']) {
            $databaseManager->deleteCharacterActivity($_POST['deleteActivityCharacter']);
        }    
?>