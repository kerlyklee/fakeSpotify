<?php
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");
    $account = new Account();
    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");
    function getInputValue($inputName) {
        if(isset($_POST[$inputName])) {
            echo $_POST[$inputName];
        }
    }
?>
<html>
<head>
<title> Log in to your account </title>
</head>
<body>
 <div id="inputConteiner">
    <form id="logInForm" action="register.php" method="POST">
    <h2> Login to your account </h2>
    <label for="userName">Username</lable>
    <input id="userName" name="userName" type="text" placeholder="Enter username.." required> <br>
    <lable for="userPassword"> Password </label>
    <input id="userPassword" name="userPassword" placeholder="At least 8 characters.." type="password" required> <br>
    <button type="submit" name="LoginButton">Log In</button> 
    </form>

    <form id="registerForm" action="register.php" method="POST">
    <h2> Greate a free accaount </h2>
    <?php echo $account->getError(Constants::$firstNameLenght); ?>
    <label for="firstName">First name </lable>
    <input id="firstName" name="firstName" type="text" placeholder="Enter your firstname.." value="<?php getInputValue('firstName') ?>" required> <br>
    <?php echo $account->getError(Constants::$lastNameLenght); ?>
    <lable for="lastName">Last name </lable>
    <input id="lastName" name="lastName" type="text" placeholder="Enter your lastname.." value="<?php getInputValue('lastName') ?>" reguired> <br>
    <?php echo $account->getError(Constants::$userNameLenght); ?>
    <lable for="regUsername"> Username </lable>
    <input id="regUsername" name="regUsername" type="text" placeholder="Choose your username.." value="<?php getInputValue('regUsername') ?>"required><br>
    <?php echo $account->getError(Constants::$emailsDoNotMatch); 
    echo $account->getError(Constants::$emailNotValid);?>
    <lable for="email"> Enter your email </lable>
    <input id="email" name="email" type="email" placeholder="sample@gmail.com" value="<?php getInputValue('email') ?>" required><br>
    <lable for="checkEmail"> Confirm email </lable>
    <input id="checkEmail" name="checkEmail" type="email" placeholder="confirm email.." value="<?php getInputValue('checkEmail') ?>" required><br>
    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
    <?php echo $account->getError(Constants::$passwordsNotAlphanumeric); ?>
    <?php echo $account->getError(Constants::$passwordLenght); ?>
    <lable for="regPassword"> Enter Password </lable>
    <input id="regPassword" name="regPassword" type="password" placeholder="At least 8 characters.." required><br>
    <lable for="checkPassword"> Confirm password </lable>
    <input id="checkPassword" name="checkPassword" type="password" placeholder="At least 8 characters.." required><br>
    <button type="submit" name="registerButton">Register </button>

 </div>

</body>
</html>

