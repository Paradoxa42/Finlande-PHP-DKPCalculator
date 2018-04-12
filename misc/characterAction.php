<?php 
    //If the user submitted an activity ID we add this activity to the activities a character did, its ID is got from GET method 
    if ($_POST['activity']) {
        $activity_san = $vanidanitizator->sanitizeNumber($_POST['activity']);
        if ($activity_san && $vanidanitizator->validateNumber($activity_san) && $vanidanitizator->validateNumber($_GET['id']))
            $databaseManager->addCharacterActivity($_GET['id'], $activity_san);
    }
    
    //If the user submit the deleteActivityCharacter with the ID of an activity we delete the activity from the database
    if ($_POST['deleteActivityCharacter']) {
        $delete_san = $vanidanitizator->sanitizeNumber($_POST['deleteActivityCharacter']);
        if ($activity_san && $vanidanitizator->validateNumber($delete_san))
            $databaseManager->deleteCharacterActivity($delete_san);
        }    
?>