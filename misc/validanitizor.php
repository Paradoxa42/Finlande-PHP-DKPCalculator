<?php 

//Class That can validate AND sanitize variables
class validanitizor {

    function __construct() {}


    //Print the error message in an alert bag
    function print_error_message($error) {
        echo $error_msg = "<div class='alert alert-danger'><strong>$error</strong></div>";
    }

    //Sanitize a number and check if it exist
    function sanitizeNumber($int, $inputName) {
        if (!$int) {
            $this->print_error_message("Error number ".$inputName." is empty");
            return false;
        }
        if (!($int = filter_var($int, FILTER_SANITIZE_NUMBER_INT))) {
            $this->print_error_message("Error in sanitization number ".$inputName." is invalide");
            return false;
        }
        return $int;
    }

    //Validate a number and check if it exist
    function validateNumber($int, $inputName) {
        if (!$int) {
            $this->print_error_message("Error number ".$inputName." is empty");
            return false;
        }
        if (!(filter_var($int, FILTER_VALIDATE_INT))) {
            $this->print_error_message("Error in validation number ".$inputName." is invalide");
            return false;
        }
        return true;
    }

    //Sanitize a String and check if it exist
    function sanitizeString($string, $inputName) {
        if (!$string) {
            $this->print_error_message("Error String ".$inputName." is empty");
            return false;
        }
        if (!($string = filter_var($string,FILTER_SANITIZE_STRING))) {
            $this->print_error_message("Error in sanitization String ".$inputName." is invalide");
            return false;
        }
        return $string;
    }

    //Validate a string and check if it exist
    function validateString($string, $inputName) {
        if (!$string) {
            $this->print_error_message("Error String ".$inputName." is empty");
            return false;
        }
        /*if (!filter_var($string,FILTER_STRING)) {
            $this->print_error_message("Error in validation String ".$inputName." is invalide");
            return false;
        }*/
        return true;
    }
}

$vanidanitizator = new validanitizor();
?>