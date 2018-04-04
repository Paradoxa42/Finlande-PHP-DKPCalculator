<?php 
    if ($_POST['activity']) {
        $databaseManager->addCharacterActivity($_GET['id'], $_POST['activity']);
    }
?>