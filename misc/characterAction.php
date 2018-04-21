<?php 
    //If the user submitted an activity ID we add this activity to the activities a character did, its ID is got from GET method 
    if ($_POST['activity']) {
        $activity_san = $vanidanitizator->sanitizeNumber($_POST['activity']);
        if ($activity_san && $vanidanitizator->validateNumber($activity_san) && $vanidanitizator->validateNumber($_GET['id']))
            $databaseManager->addCharacterActivity($_GET['id'], $activity_san);
    }
    
    //If the user submit the deleteActivityCharacter with the ID of an activity we delete the activity from the database
    if ($_GET['deleteActivityCharacter']) {
        echo "lol";
        $delete_san = $vanidanitizator->sanitizeNumber(intval($_GET['deleteActivityCharacter']));
        if ($delete_san && $vanidanitizator->validateNumber(intval($delete_san)))
            $databaseManager->deleteCharacterActivity($delete_san);
    }
    //If the user submit the putNameCharacter with the new name, we change the name of the character in the database
    if ($_POST['putNameCharacter']) {
        $name_san = $vanidanitizator->sanitizeString($_POST['putNameCharacter']);
        if ($name_san && $vanidanitizator->validateString($name_san)) {
            $databaseManager->putCharacterName($name_san, $_GET['id']);
        }
    }
?>