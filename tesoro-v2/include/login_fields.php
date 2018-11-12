<?php
	$usernameErr = $passwordErr = "";
	$username = $password = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["username"]) && empty($_POST["password"])) {
			$usernameErr = "Username is required";
			$passwordErr = "Password is required";
		} else if (empty($_POST["username"]) && !empty($_POST["password"])) {
			$usernameErr = "Username is required";
			$password = test_input($_POST["password"]);
		} else if (!empty($_POST["username"]) && empty($_POST["password"])) {
			$passwordErr = "Password is required";
			$username = test_input($_POST["username"]);
		} else {
			$username = test_input($_POST["username"]);
			$password = MD5(test_input($_POST["password"]));
			include ('config/session.php');
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/modified/form.css">	
</head>

<style type="text/css">
	#message {
		position: relative;
		margin: 20px auto;
		display:none;
	}

	#message p {
		font-size: 16px;
	}

	.valid {
		color: green;
	}

	.valid:before {
		margin: 10px;
		content: "✔";
	}

	.invalid {
		color: red;
	}

	.invalid:before {
		margin: 10px;
		content: "✖";
	}

	.error {
		color: #FF0000;
		font-size: 11px;
	}
</style>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="login-form mb-3">
					<center>
						<a href="index.php"><img src="images/JOMIS_logo.png" width="225px" alt=""><a/>
					</center>
					<form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
						<input type="text" class="form-control" value="<?php echo $username;?>" name="username" placeholder="Username or Email" autofocus>
						<span class="error">* <?php echo $usernameErr;?></span><br>
						<input type="password" class="form-control" style="margin-bottom: -2px;" value="<?php echo $password;?>" name="password" placeholder="Password" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
						<span class="error">* <?php echo $passwordErr;?></span>
						<button class="btn btn-lg btn-danger btn-block" style="margin-top: 10px;" type="submit" name="login">Log In</button>
					</form>
					<center><a href="create.php" class="text-center">Create an Account </a></center>
				</div>
			</div>
		</div>

		<div class="row">
			<div id="message">
				<h6>Password must contain the following:</h6>
				<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
				<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
				<p id="number" class="invalid">A <b>number</b></p>
				<p id="length" class="invalid">Minimum <b>8 characters</b></p>
			</div>
		</div>
	</div>
				
	<script>
		var myInput = document.getElementById("psw");
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");

		myInput.onfocus = function() {
			document.getElementById("message").style.display = "block";
		}

		myInput.onblur = function() {
			document.getElementById("message").style.display = "none";
		}

		myInput.onkeyup = function() {
			var lowerCaseLetters = /[a-z]/g;
			if(myInput.value.match(lowerCaseLetters)) {  
				letter.classList.remove("invalid");
				letter.classList.add("valid");
			} else {
				letter.classList.remove("valid");
				letter.classList.add("invalid");
			}

			var upperCaseLetters = /[A-Z]/g;
			if(myInput.value.match(upperCaseLetters)) {  
				capital.classList.remove("invalid");
				capital.classList.add("valid");
			} else {
				capital.classList.remove("valid");
				capital.classList.add("invalid");
			}

			var numbers = /[0-9]/g;
			if(myInput.value.match(numbers)) {  
				number.classList.remove("invalid");
				number.classList.add("valid");
			} else {
				number.classList.remove("valid");
				number.classList.add("invalid");
			}
  
			if(myInput.value.length >= 8) {
				length.classList.remove("invalid");
				length.classList.add("valid");
			} else {
				length.classList.remove("valid");
				length.classList.add("invalid");
			}
		}
	</script>
</body>
</html>