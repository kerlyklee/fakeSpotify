<?php
class Account {
    private $errorArray;

    public function __construct() {
        $this->errorArray = array();
    }
    public function register($fn, $ln, $un, $em, $em2, $pas, $ckpas) {
        $this->validateFirstname($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmails($em, $em2);
        $this->validatePassword($pas, $ckpas);

        if(empty($this->errorArray)){
            //insert data into database
            return true;
        }
        else {
            return false;
        }
           
    }
    public function getError($error) {
        if(!in_array($error, $this->errorArray)) {
            $error = "";

        }
        return "<span class='errorMessage'>$error</span>";

    }
    private function validateFirstname($fn) {
        if(strlen($fn) > 1000) {
            array_push($this->errorArray, Constants::$firstNameLenght);
            return;
        }
    }
    private function validateLastName($ln) {
        if(strlen($ln) > 1000) {
            array_push($this->errorArray, Constants::$lastNameLenght);
            return;
        }
        
    }
    private function validateUsername($un) {
        if(strlen($un) > 25 || strlen($un) < 5) {
            array_push($this->errorArray, Constants::$userNameLenght);
            return;
        }
        //TODO: check that doesnt exist
    
    }
    private function validateEmails($em, $em2) {
        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailNotValid);
            return;
        }
        //check that email dont exist

        
    }
    private function validatePassword($pas, $ckpas) {
        if($pas != $ckpas) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }
        if(preg_match('/[^A-Za-z0-9]/', $pas)){
            array_push($this->errorArray, Constants::$passwordsNotAlphanumeric);
        }
        if(strlen($pas) < 8 || strlen($pas) > 250){
            array_push($this->errorArray, Constants::$passwordLenght);
        }
        
    }
}
?>