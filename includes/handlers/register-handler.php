
<?php
    
function sanitizeFromText($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ","", $inputText);
    return $inputText;
}
function sanitizeName($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ","", $inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}
function sanitizePassword($inputText) {
    $inputText = strip_tags($inputText);
    return $inputText;
}


if(isset($_POST['LoginButton'])) {
    echo "login was pressed";
}
if(isset($_POST['registerButton'])) {
    $firstName = sanitizeName($_POST['firstName']);
    $lastName = sanitizeName($_POST['lastName']);
    $regUsername = sanitizeFromText($_POST['regUsername']);
    $email = sanitizeFromText($_POST['email']);
    $checkEmail = sanitizeFromText($_POST['checkEmail']);
    $regPassword = sanitizePassword($_POST['regPassword']);
    $checkPassword = sanitizePassword($_POST['checkPassword']);

    $noErrors = $account->register($firstName, $lastName, $regUsername, $email, $checkEmail, $regPassword, $checkPassword);
    if($noErrors  == true) {
        $_SESSION['userLoggedIn'] = $regUsername;
       header("Location: index.php");
    }

}

?>