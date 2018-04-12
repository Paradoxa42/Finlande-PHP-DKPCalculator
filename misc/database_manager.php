<?php
class database_manager {
    private $database_link;
    
    /**
     * When we instanciate the class we connect to the database
     */
    function __construct() {
        $connectstr_dbhost = 'localhost'; 
        $connectstr_dbname = 'dkpTable'; 
        $connectstr_dbusername = 'root'; 
        $connectstr_dbpassword = 'dfghj'; 
        $this->database_manager = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname); 
          
if (!$this->database_manager) { 
    echo "Error: Unable to connect to MySQL." . PHP_EOL; 
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL; 
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL; 
    exit; 
  }   
}

    /**
     * We disconnect from the database when we destroy this class
     */
    function __destruct() {
        mysqli_close($this->database_manager);
    }

    /**
     * Get a character score
     */
    function getCharacterScore($character_id) {
        $activities = $this->getActivityCharacterList($character_id);
        $score['total'] = 0;
        $score['month'] = 0;
        $now = new Datetime();
        $now = $now->format('m');
        foreach ($activities as $item) {
            $date = new DateTime($item['dateTime']);
            $date = $date->format('m');
            if ($now == $date) {
                $score['month'] += $item['dkpEarn'];
            }
            $score['total'] += $item['dkpEarn'];
        }
        return $score;
    }

    /**
     * Convert sql result to array
     */
    function result_to_array($results) {
        $items = [];
        while ($item = mysqli_fetch_array($results)) {
            $items[] = $item;
        }
        return $items;        
    }

    /**
     * Connect the User with username and password
     */
    function login($name, $password) {
        $query = "SELECT name, password FROM characters WHERE name LIKE '%".$name."%'";
        $item = mysqli_query($this->database_manager, $query);
        $item = $this->result_to_array($item);
        if (count($item) == 0) {
            echo "RIEN";
            return false;
        }
        echo $item[0]['name'].$item[0]['password'];
        return ($item[0]['name'] == $name && password_verify($password,$item[0]['password']));
    }

    /* Get the list of the characters with their name */
    function getCharacterList() {
        $items = mysqli_query($this->database_manager, "SELECT id,name from characters");
        return $this->result_to_array($items);
    }

    /* Get a precise character with his name, his score and his activites */
    function getCharacter($id) {
        $item = mysqli_query($this->database_manager, "SELECT name from characters WHERE id = ".strval($id));
        return mysqli_fetch_array($item);
    }

    /* Add a character */
    function addCharacter($name, $password) {
        $query = "INSERT INTO characters (id, name, password) VALUES (NULL, '".$name."', '".$password."')";
        echo $query;
        $item = mysqli_query($this->database_manager, $query);
        if (!$item) {
            echo "Error mysql ".mysqli_error($this->database_manager);
        }
    }

    /* Delete a character and his activities */
    function deleteCharacter($id) {
        mysqli_query($this->database_manager, "DELETE FROM characters WHERE characters.id = ".strval($id));
        mysqli_query($this->database_manager, "DELETE FROM activity WHERE activity.idCharacter = ".strval($id));
    }

    /* Get the list of the activities */
    function getActivityList() {
        $items = mysqli_query($this->database_manager, "SELECT * from activityModel");
        if (!$items) {
            echo "Error mysql ".mysqli_error($this->database_manager);
        }
        return $this->result_to_array($items);
    }

    /* Add an activity */
    function addActivity($name, $earning) {
        $query = "INSERT INTO activityModel (id, name, dkpEarn) VALUES (NULL, '" . strval($name)."', '".strval($earning)."')";
        $items = mysqli_query($this->database_manager, $query);
        if (!$items) {
            echo "Error mysql ".mysqli_error($this->database_manager);
        }
    }

    /* Delete an activity and all activities that characters have done */
    function deleteActivity($id) {
        $item = mysqli_query($this->database_manager, "DELETE FROM activityModel WHERE activityModel.id = " . strval($id));
        if (!$item) {
            echo "Error mysql ".mysqli_error($this->database_manager);
            return false;
        }
        $item = mysqli_query($this->database_manager, "DELETE FROM activity WHERE activity.idActivity = " . strval($id));
        if (!$item) {
            echo "Error mysql ".mysqli_error($this->database_manager);
            return false;
        }
        return true;
    }
    
    /* Get all activites that a character has done */
    function getActivityCharacterList($id_character) {
        $query = "SELECT activity.id, activityModel.name, activityModel.dkpEarn, activity.dateTime from activity, activityModel WHERE activity.idCharacter = " . strval($id_character)." AND activity.idActivity = activityModel.id";
        $item = mysqli_query($this->database_manager, $query);
        return $this->result_to_array($item);
    }

    /* Add an activity to a character */
    function addCharacterActivity($id_character, $id_activity) {
        $now = new DateTime();
        $query = "INSERT INTO activity (id, idCharacter, idActivity, dateTime) VALUES (NULL, '" . strval($id_character) . "', '" . strval($id_activity) . "', '" . $now->format("Y-m-d") . "');";
        $item = mysqli_query($this->database_manager, $query);
        if (!$item) {
            echo "Error mysql ".mysqli_error($this->database_manager);
        }
    }

    /* Delete the activity of a character */
    function deleteCharacterActivity($id) {
        $item = mysqli_query($this->database_manager, "DELETE FROM activity WHERE activity.id = " . strval($id));
        if (!$item) {
            echo "Error mysql ".mysqli_error($this->database_manager);
        }
    }
}

$databaseManager = new database_manager();
?>