<?php
// start the session
session_start();

// check if user already logged in, if so redirect back to home
if(isset($_SESSION['user'])) {
	header('Location: /index.php');
	die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="./static/css/login.css">
</head>
<body>
	<main id="MainBody">
		<div class="part form">
			<!-- <h1 class="">Project Name</h1> -->
			<div class="container">
				<form class="login" id="LoginForm" onsubmit="OnLogin(event)">
					<p class="greet">Welcome!</p>
					<div class="field bordered">
						<span class="selected"></span>
						<label for="email">Email</label>
						<input type="text" name="email" id="email" placeholder="eg. emailname@gmail.com" value="adfadfadf@email.com">
					</div>
					<div class="field bordered">
						<span class="selected"></span>
						<label for="password">Passwort</label>
						<input type="password" name="password" id="password" placeholder="*********" value="testpassword">
					</div>
					
					<div class="field">
						<input type="checkbox" name="remeberMe" id="remeberMe">
						<label for="passwort">Remember Me</label>
					</div>
					<div class="field">
						<input type="submit" value="Login" class="btn loginBtn">
						<button class="btn registerBtn" onclick="return SwitchForms()">Register</button>
					</div>
				</form>
				<form class="register" onsubmit="OnRegister(event)">
					<p class="greet">Join us!</p>

					<div class="field bordered">
						<span class="selected"></span>
						<label for="first_name">First Name</label>
						<input type="text" name="first_name" placeholder="eg. John" value="John">
					</div>
					<div class="field bordered">
						<span class="selected"></span>
						<label for="last_name">Last Name</label>
						<input type="text" name="last_name" placeholder="eg. Doe" value="Doe">
					</div>
					<div class="field bordered">
						<span class="selected"></span>
						<label for="address">Address</label>
						<input type="text" name="address" id="address" placeholder="eg. Egypt" value="Alexandria">
					</div>
					<div class="field bordered">
						<span class="selected"></span>
						<label for="industry">Tndustry</label>
						<input type="text" name="industry" id="industry" placeholder="eg. IT" value="IT">
					</div>
					<div class="field bordered">
						<span class="selected"></span>
						<label for="email">Email</label>
						<input type="text" name="email" placeholder="eg. JohnDoe@gmail.com" value="JohnDoe@gmail.com">
					</div>
					<div class="field bordered">
						<span class="selected"></span>
						<label for="email">Password</label>
						<input type="text" name="password" placeholder="******" value="testpassword">
					</div>
					<div class="field">
						<input type="checkbox" name="is_recruiter" id="isRecruiter">
						<label for="is_recruiter">Are you a recruiter?</label>
					</div>
					<div class="field">
						<input type="submit" value="Register" class="btn loginBtn">
						<button class="goToLoginBtn" onclick="return SwitchForms()">I already have an account</button>
					</div>
				</form>
				<div id="ErrorBox"></div>
			</div>
		</div>
		<div class="part image"></div>
	</main>
	<script src="./static/js/login.js"></script>
</body>
</html>