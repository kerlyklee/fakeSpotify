<?php
if(isset($_POST['loginButton'])) {
    $username = $_POST['username'];
    $password = $_POST['userPassword'];

    $result = $account->login($username, $password);

    if($result) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }

}

?>