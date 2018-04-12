<?php

class database_manager {
    private $database_manager;
    
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
     * Prepare SQL statement if fail throw error, if not return mysql results
     */
    function perform_query($query) {
        //If the query is null we throw and exeption
        if ($query == null) {
            throw new Exception("Error query null");
        }
        $stmt = mysqli_prepare($this->database_manager, $query);
        if ($stmt) {
            $stmt->execute();
            $results = $stmt->get_result();
            $stmt->free_result();
            $stmt->close();
            return $results;
        }
        else {
            throw new Exception(mysqli_error($this->database_manager));
        }
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

    function print_error_message($error) {
        echo $error_msg = "<div class='alert alert-danger'><strong>$error</strong></div>";
    }

    /**
     * Connect the User with username and password
     */
    function login($name, $password) {
        $query = "SELECT name, password FROM characters WHERE name LIKE '%".$name."%'";
        try {
            $this->perform_query($query);
            $item = $this->perform_query($query);
            $item = $this->result_to_array($item);
            if (count($item) == 0) {
                return false;
            }
            echo $item[0]['name'].$item[0]['password'];
            return ($item[0]['name'] == $name && password_verify($password,$item[0]['password']));
        } catch (Exception $ex) {
            $this->print_error_message("Unable to login");
            return false;
        }
    }

    /* Get the list of the characters with their name */
    function getCharacterList() {
        try {
            $items = $this->perform_query("SELECT id,name from characters");
            return $this->result_to_array($items);
        } catch(Exception $ex) {
            $this->print_error_message("Unable to get the characterList");
            return null;
        }
    }

    /* Get a precise character with his name, his score and his activites */
    function getCharacter($id) {
        try {
            $item = $this->perform_query("SELECT name from characters WHERE id = ".strval($id));
            return mysqli_fetch_array($item);    
        } catch(Exception $ex) {
            $this->print_error_message("Error in getting Character by ID : ".$id);
            return null;
        }
    }

    /* Add a character */
    function addCharacter($name, $password) {
        $query = "INSERT INTO characters (id, name, password) VALUES (NULL, '".$name."', '".$password."')";
        try {
            $item = $this->perform_query("SELECT name from characters WHERE id = ".strval($id));
            return mysqli_fetch_array($item);    
        } catch(Exception $ex) {
            $this->print_error_message("Unable to add Character");
            return null;
        }
    }

    /* Delete a character and his activities */
    function deleteCharacter($id) {
        try {
            $this->perform_query("DELETE FROM characters WHERE characters.id = ".strval($id));
            $this->perform_query("DELETE FROM activity WHERE activity.idCharacter = ".strval($id));    
        } catch(Exception $ex) {
            $this->print_error_message("Unable to delete Character");
        }
    }

    /* Get the list of the activities */
    function getActivityList() {
        try {
            $items = $this->perform_query("SELECT * from activityModel");
            return $this->result_to_array($items);
        } catch (Exception $ex) {
            $this->print_error_message("Unable to Getting Activity List");
            return null;
        }
    }

    /* Add an activity */
    function addActivity($name, $earning) {
        try {
            $query = "INSERT INTO activityModel (id, name, dkpEarn) VALUES (NULL, '" . strval($name)."', '".strval($earning)."')";
            $items = $this->perform_query($query);
        } catch(Exception $ex) {
            $this->print_error_message("Unable to Add Activity");
        }
    }

    /* Delete an activity and all activities that characters have done */
    function deleteActivity($id) {
        try {
            $item = $this->perform_query("DELETE FROM activityModel WHERE activityModel.id = " . strval($id));
            $item = $this->perform_query("DELETE FROM activity WHERE activity.idActivity = " . strval($id));
            return true;    
        } catch(Exception $ex) {
            $this->print_error_message("Unable to Delete activity");
        } 
    }
    
    /* Get all activites that a character has done */
    function getActivityCharacterList($id_character) {
        try {
            $query = "SELECT activity.id, activityModel.name, activityModel.dkpEarn, activity.dateTime from activity, activityModel WHERE activity.idCharacter = " . strval($id_character)." AND activity.idActivity = activityModel.id";
            $item = $this->perform_query($query);
            return $this->result_to_array($item);
        } catch(Exception $ex) {
            $this->print_error_message("Unable to Get activities of a character");
            return null;
        }
    }

    /* Add an activity to a character */
    function addCharacterActivity($id_character, $id_activity) {
        try {
            $now = new DateTime();
            $query = "INSERT INTO activity (id, idCharacter, idActivity, dateTime) VALUES (NULL, '" . strval($id_character) . "', '" . strval($id_activity) . "', '" . $now->format("Y-m-d") . "');";
            $item = $this->perform_query($query);    
        } catch (Exception $ex) {
            $this->print_error_message("Unable to add activity to character");
        }
    }

    /* Delete the activity of a character */
    function deleteCharacterActivity($id) {
        try {
            $item = $this->perform_query("DELETE FROM activity WHERE activity.id = " . strval($id));    
        } catch (Exception $ex) {
            $this->print_error_message("Unable to delete activity to character");
        }
    }
}

$databaseManager = new database_manager();
?>