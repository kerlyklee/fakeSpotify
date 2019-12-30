<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($connection);

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
	<title>Welcome!</title>
    <webview id="foo" src="http://www.google.com/" style="width:640px; height:480px"></webview>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
    <?php 
    if(isset($_POST['registerButton'])) {
        echo '  <script>
        $(document).ready(function() {
            $("#loginForm").hide();
            $("#registerForm").show();
        });
    </script>';
    }
    else {
      echo  '<script>
        $(document).ready(function() {
            $("#loginForm").show();
            $("#registerForm").hide();
        });
    </script>';
    }
    ?>

	<div id="background">

		<div id="loginContainer">

			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<label for="userName">Username</label>
						<input id="userName" name="username" type="text" placeholder="Enter your username.." value="<?php getInputValue('username') ?>" required>
					</p>
					<p>
						<label for="userPassword">Password</label>
						<input id="userPassword" name="userPassword" type="password" placeholder="Enter your password.." required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>

					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Signup here.</span>
					</div>
					
				</form>



				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(Constants::$firstNameLenght); ?>
						<label for="firstName">First name</label>
						<input id="firstName" name="firstName" type="text" placeholder="Enter your firstname.." value="<?php getInputValue('firstName') ?>" required>					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameLenght); ?>
						<lable for="lastName">Last name </lable>
						<input id="lastName" name="lastName" type="text" placeholder="Enter your lastname.." value="<?php getInputValue('lastName') ?>" reguired> 
					</p>

					<p>
						<?php echo $account->getError(Constants::$userNameLenght); ?>
						<?php echo $account->getError(Constants::$usernameExists); ?>
						<lable for="regUsername"> Username </lable>
						<input id="regUsername" name="regUsername" type="text" placeholder="Choose your username.." value="<?php getInputValue('regUsername') ?>"required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); 
						echo $account->getError(Constants::$emailNotValid);
						echo $account->getError(Constants::$emailExists);?>
						<lable for="email"> Enter your email </lable>
						<input id="email" name="email" type="email" placeholder="sample@gmail.com" value="<?php getInputValue('email') ?>" required>
					
					</p>

					<p>
						<lable for="checkEmail"> Confirm email </lable>
						<input id="checkEmail" name="checkEmail" type="email" placeholder="confirm email.." value="<?php getInputValue('checkEmail') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$passwordsNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordLenght); ?>
						<lable for="regPassword"> Enter Password </lable>
						<input id="regPassword" name="regPassword" type="password" placeholder="At least 8 characters.." required>
					</p>

					<p>
						<lable for="checkPassword"> Confirm password </lable>
						<input id="checkPassword" name="checkPassword" type="password" placeholder="At least 8 characters.." required>
                    
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Log in here.</span>
					</div>
					
				</form>


            </div>
        <div id="loginSideText">
            <h1> Listen to great music, right here </h1>
            <h2> We offer thousand of songs in diffrent styles for free! </h2>
            <ul>
                <li> Discover new music </li>
                <li> Listen your favourites over and over again </li>
                <li> Greate awsome playlists </li>
            </ul>
        </div>
		</div>
	</div>

</body>
</html>