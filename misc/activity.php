<?php
    echo "Lol";
    if ($_POST['nameActivity'] && $_POST['earnActivity']) {
        $databaseManager->addActivity($_POST['nameActivity'], $_POST['earnActivity']);
    }
?>