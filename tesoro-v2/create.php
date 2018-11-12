<?php
	include ("config/verify.php");

	if(isset($_POST['signup'])){
		$type = 1;
		$status = 'Active';
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$rpassword = md5($_POST['rpassword']);
		$email = $_POST['email'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$bdate = $_POST['bdate'];
		$gender = $_POST['gender'];
		$picture = 'default';
		
		if(strcmp($password,$rpassword) != 0){
			$_SESSION['username'] = $username = $_POST['username'];
			$_SESSION['email'] = $email = $_POST['email'];
			$_SESSION['fname'] = $fname = $_POST['fname'];
			$_SESSION['mname'] = $mname = $_POST['mname'];
			$_SESSION['lname'] = $lname = $_POST['lname'];
			$_SESSION['bdate'] = $bdate = $_POST['bdate'];
			$_SESSION['gender'] = $gender = $_POST['gender'];?>
				
			<script type="text/javascript">
				alert("Passwords does not matched!");
				window.location.href='create.php';
			</script><?php
		}else{
			$sql_query2="SELECT * FROM users_list WHERE BINARY (firstname='$fname' AND middlename='$mname' AND lastname='$lname') || (username='$username') || (email='$email')";
			$result_set2=mysqli_query($conn,$sql_query2);
			$fetched_row2=mysqli_num_rows($result_set2);
		
			if($fetched_row2>0){
				$_SESSION['username'] = $username = $_POST['username'];
				$_SESSION['email'] = $email = $_POST['email'];
				$_SESSION['fname'] = $fname = $_POST['fname'];
				$_SESSION['mname'] = $mname = $_POST['mname'];
				$_SESSION['lname'] = $lname = $_POST['lname'];
				$_SESSION['bdate'] = $bdate = $_POST['bdate'];
				$_SESSION['gender'] = $gender = $_POST['gender'];?>

				<script type="text/javascript">
					alert("Account already exists, please verify it to the Support Maintenance!")
					window.location.href='create.php';
				</script><?php
			}else{
				$sql_query = "INSERT INTO users_list (type,status,username,email,password,firstname,middlename,lastname,birthdate,gender,picture,added_on) VALUES ('$type','$status','$username','$email','$password','$fname','$mname','$lname','$bdate','$gender','$picture',NOW())";

				if(mysqli_query($conn,$sql_query)){
					$_SESSION['username'] = NULL;
					$_SESSION['email'] = NULL;
					$_SESSION['fname'] = NULL;
					$_SESSION['mname'] = NULL;
					$_SESSION['lname'] = NULL;
					$_SESSION['bdate'] = NULL;
					$_SESSION['gender'] = NULL;?>

					<script type="text/javascript">
						alert("Account successfully created and activated as Limited User!");
						window.location.href='login.php';
					</script><?php
				}else{
					$_SESSION['username'] = $username = $_POST['username'];
					$_SESSION['email'] = $email = $_POST['email'];
					$_SESSION['fname'] = $fname = $_POST['fname'];
					$_SESSION['mname'] = $mname = $_POST['mname'];
					$_SESSION['lname'] = $lname = $_POST['lname'];
					$_SESSION['bdate'] = $bdate = $_POST['bdate'];
					$_SESSION['gender'] = $gender = $_POST['gender'];?>

					<script type="text/javascript">
						alert("Error occured while creating an account!");
						window.location.href='create.php';
					</script><?php
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
	<title>JOMIS | Create An Account</title>
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
		<div class="row mt-4">
			<div class="col-lg-12">
				<center>
					<a href="index.php"><img src="images/JOMIS_logo.png" width="225px" alt=""><a/>
				</center>
				</div>
			</div>
		</div>

		<center><h4 class="mt-3" style="padding: 0px 30px;">Create an Account</h4></center>

		<form action="create.php" method="POST" style="padding: 0px 50px;">
			<div class="row">
				<div class="col-xl">
					<div class="form-group row">
						<label class="col-12 col-form-label" for="fname">First Name</label>					
						<div class="col-12">
							<input type="text" class="form-control" id="fname" value="<?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname'];}?>" placeholder="Enter First Name" name="fname" required>
						</div>
					</div>
				</div>

				<div class="col-xl">
					<div class="form-group row">
						<label class="col-12 col-form-label" for="mname">Middle Name</label>
						<div class="col-12">
							<input type="text" class="form-control" id="mname" value="<?php if(isset($_SESSION['mname'])){ echo $_SESSION['mname'];}?>" placeholder="Enter Middle Name" name="mname" required>
						</div>
					</div>
				</div>

				<div class="col-xl">
					<div class="form-group row">
						<label class="col-12 col-form-label" for="lname">Last Name</label>
						<div class="col-12">
							<input type="text" class="form-control" id="lname" value="<?php if(isset($_SESSION['lname'])){ echo $_SESSION['lname'];}?>" placeholder="Enter Last Name" name="lname" required>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xl">
					<div class="form-group row">
						<label class="col-12 col-form-label" for="bdate">Birthdate</label>
						<div class="col-12">
							<input type="date" class="form-control" id="bdate" placeholder="YYYY-MM-DD" value="<?php if(isset($_SESSION['bdate'])){ echo $_SESSION['bdate'];}?>" name="bdate" required>
						</div>
					</div>
				</div>

				<div class="col-xl">
					<div class="form-group row">
						<label class="col-12 col-form-label" for="gender">Gender</label>
						<div class="col-12">
							<select class="custom-select" id="gender" name="gender" required><?php
								if(isset($_SESSION['gender'])){
									if($_SESSION['gender']=='Female'){?>
										<option value="">None</option>
										<option value="Female" selected>Female</option>
										<option value="Male">Male</option><?php
									}else if ($_SESSION['gender']=='Male'){?>
										<option value="">None</option>
										<option value="Female">Female</option>
										<option value="Male" selected>Male</option><?php
									}
								}else{?>
									<option value="">None</option>
									<option value="Female">Female</option>
									<option value="Male">Male</option><?php						
								}?>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="row">  
				<div class="col-xl">
					<div class="form-group row">
						<label class="col-12 col-form-label" for="username">Username</label>
						<div class="col-12">
							<input type="text" class="form-control" id="username" value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];}?>" placeholder="Enter Username" name="username" required>
						</div>
					</div>
				</div>

				<div class="col-xl">
					<div class="form-group row">
						<label class="col-12 col-form-label" for="email">Email Address</label>
						<div class="col-12">
							<input type="email" class="form-control" id="email" value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email'];}?>" placeholder="Enter Email Address" name="email" required>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xl">
					<div class="form-group row">
						<label class="col-12 col-form-label" for="password">Password</label>
						<div class="col-12">
							<input type="password" class="form-control" id="password" placeholder="Enter Password" name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
						</div>
					</div>
					<div id="message_p">
						<h6>Password must contain the following:</h6>
						<p id="letter_p" class="invalid">A <b>lowercase</b> letter</p>
						<p id="capital_p" class="invalid">A <b>capital (uppercase)</b> letter</p>
						<p id="number_p" class="invalid">A <b>number</b></p>
						<p id="length_p" class="invalid">Minimum <b>8 characters</b></p>
					</div>
				</div>

				<div class="col-xl">
					<div class="form-group row">
						<label class="col-12 col-form-label" for="rpassword">Repeat Password</label>
						<div class="col-12">
							<input type="password" class="form-control" id="rpassword" placeholder="Repeat Password" name="rpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
						</div>
					</div>
					<div id="message_p">
						<h6>Repeat Password must contain the following:</h6>
						<p id="match_r" class="invalid"><b>Matched</b> with your <b>Password</b></p>
					</div>
				</div>
			</div>
	
			<script>
				var myInput_p = document.getElementById("password");
				var letter_p = document.getElementById("letter_p");
				var capital_p = document.getElementById("capital_p");
				var number_p = document.getElementById("number_p");
				var length_p = document.getElementById("length_p");			
				var myInput_r = document.getElementById("rpassword");

				myInput_p.onfocus = function() {
					document.getElementById("message_p").style.display = "block";
				}
		
				myInput_p.onblur = function() {
					document.getElementById("message_p").style.display = "block";
				}

				myInput_p.onkeyup = function() {
					if(myInput_r.value!=myInput_p.value) {  
						match_r.classList.remove("valid");
						match_r.classList.add("invalid");
						document.getElementById("sign_d").style.display = "inline";
						document.getElementById("sign_e").style.display = "none";
					} else {
						if(myInput_r.value.length > 0){
							match_r.classList.remove("invalid");
							match_r.classList.add("valid");
							if(myInput_r.value.length > 0){
								document.getElementById("sign_e").style.display = "inline";
								document.getElementById("sign_d").style.display = "none";
							}else{
								document.getElementById("sign_d").style.display = "inline";
								document.getElementById("sign_e").style.display = "none";
							}
						}else{
							match_r.classList.remove("valid");
							match_r.classList.add("invalid");
							document.getElementById("sign_d").style.display = "inline";
							document.getElementById("sign_e").style.display = "none";
						}
					}
					
					var lowerCaseLetters_p = /[a-z]/g;
					if(myInput_p.value.match(lowerCaseLetters_p)) {  
						letter_p.classList.remove("invalid");
						letter_p.classList.add("valid");
					} else {
						letter_p.classList.remove("valid");
						letter_p.classList.add("invalid");
					}

					var upperCaseLetters_p = /[A-Z]/g;
					if(myInput_p.value.match(upperCaseLetters_p)) {  
						capital_p.classList.remove("invalid");
						capital_p.classList.add("valid");
					} else {
						capital_p.classList.remove("valid");
						capital_p.classList.add("invalid");
					}

					var numbers_p = /[0-9]/g;
					if(myInput_p.value.match(numbers_p)) {  
						number_p.classList.remove("invalid");
						number_p.classList.add("valid");
					} else {
						number_p.classList.remove("valid");
						number_p.classList.add("invalid");
					}
				  
					if(myInput_p.value.length >= 8) {
						length_p.classList.remove("invalid");
						length_p.classList.add("valid");
					} else {
						length_p.classList.remove("valid");
						length_p.classList.add("invalid");
					}
				}

				myInput_r.onfocus = function() {
					document.getElementById("message_p").style.display = "block";
				}

				myInput_r.onblur = function() {
					document.getElementById("message_p").style.display = "block";
				}

				myInput_r.onkeyup = function() {
					if(myInput_r.value!=myInput_p.value) {  
						match_r.classList.remove("valid");
						match_r.classList.add("invalid");
						document.getElementById("sign_d").style.display = "inline";
						document.getElementById("sign_e").style.display = "none";
					} else {
						if(myInput_r.value.length > 0){
							match_r.classList.remove("invalid");
							match_r.classList.add("valid");
							if(myInput_r.value.length >= 8){
								document.getElementById("sign_e").style.display = "inline";
								document.getElementById("sign_d").style.display = "none";
							}else{
								document.getElementById("sign_d").style.display = "inline";
								document.getElementById("sign_e").style.display = "none";
							}
						}else{
							match_r.classList.remove("valid");
							match_r.classList.add("invalid");
							document.getElementById("sign_d").style.display = "inline";
							document.getElementById("sign_e").style.display = "none";
						}
					}			
				}
			</script>
	
			<div style="float: right; padding: 20px 0px">
				<a class="btn btn-secondary"href="login.php">Cancel</a>
				<button style="display: none; margin: 0;" id="sign_e" type="submit" name="signup" class="btn btn-success">Create Account</button>
				<button style="margin: 0;" id="sign_d" type="submit" name="signup" class="btn btn-success" disabled>Create Account</button>
			</div>
		</form>
	<div>
</body>
<html>