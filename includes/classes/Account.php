<?php
class Account {
    private $connection;
    private $errorArray;

    public function __construct($connection) {
        $this->connection = $connection;
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
            return $this->insertUserDetails($fn, $ln, $un, $em, $pas);
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
    private function insertUserDetails($fn, $ln, $un, $em, $pas) {
        $encryptedPw = md5($pas);
        $profilePicture ="assets/images/profile-pics/standard.png";
        $date = date("Y-m-d");
  
      
        $result = mysqli_query($this->connection, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePicture')");
        
        return $result;

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
        $checkUsernameQuery = mysqli_query($this->connection, "SELECT username FROM users WHERE username='$un'");
        if(mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->errorArray, Constants::$usernameExists);
            return;
        }
    
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
        $checkEmailQuery = mysqli_query($this->connection, "SELECT email FROM users WHERE email='$em'");
        if(mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, Constants::$emailExists);
            return;
        }

        
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
    public function login($lun, $lpas){
        $pas = md5($lpas);
        $logInQuery = mysqli_query($this->connection, "SELECT * FROM users WHERE username='$lun' AND password='$pas'");
        if(mysqli_num_rows($logInQuery) == 1) {
            return true;
        }
        else {
            array_push($this->errorArray, Constants::$loginFailed);
            return false;


        }
           

    }
}
?>