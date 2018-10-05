<!DOCTYPE html>
<html>
<style type="text/css">
	@media (max-width: 768px) {
		.top {
			margin-top: 15px;
		}
	}

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
	<form action="login.php" method="post">
		<div class="modal-header">
			<h4 class="modal-title">Create an Account</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<div class="row">
					<div class="col-lg">
						<label for="fname">First Name</label>
						<input type="text" class="form-control" id="fname" value="<?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname'];}?>" placeholder="Enter First Name" name="fname" required>
					</div>
					<div class="col-lg top">
						<label for="mname">Middle Name</label>
						<input type="text" class="form-control" id="mname" value="<?php if(isset($_SESSION['mname'])){ echo $_SESSION['mname'];}?>" placeholder="Enter Middle Name" name="mname" required>
					</div>
					<div class="col-lg top">
						<label for="lname">Last Name</label>
						<input type="text" class="form-control" id="lname" value="<?php if(isset($_SESSION['lname'])){ echo $_SESSION['lname'];}?>" placeholder="Enter Last Name" name="lname" required>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="bdate">Birthdate</label>
						<input type="date" class="form-control" id="bdate" placeholder="YYYY-MM-DD" value="<?php if(isset($_SESSION['bdate'])){ echo $_SESSION['bdate'];}?>" name="bdate" required>
					</div>
					<div class="col">
						<label for="gender">Gender</label><br>
						<?php if(isset($_SESSION['gender'])){
							if($_SESSION['gender']=='Female'){ ?>
								<input type="radio" id="gender" name="gender" value="Female" checked required> Female<br>
								<input type="radio" id="gender" name="gender" value="Male" required> Male
								<?php 
							}else if ($_SESSION['gender']=='Male'){ ?>
								<input type="radio" id="gender" name="gender" value="Female" required> Female<br>
								<input type="radio" id="gender" name="gender" value="Male" checked required> Male
								<?php
							}
						}else { ?>
								<input type="radio" id="gender" name="gender" value="Female" required> Female<br>
								<input type="radio" id="gender" name="gender" value="Male" required> Male
								<?php
							}
						?>
					</div>
				</div>	
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-lg">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];}?>" placeholder="Enter Username" name="username" required>
					</div>
					<div class="col-lg top">
						<label for="email">Email Address</label>
						<input type="email" class="form-control" id="email" value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email'];}?>" placeholder="Enter Email Address" name="email" required>
					</div>
					
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-lg">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" placeholder="Enter Password" name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
					</div>
					<div class="col-lg top">
						<label for="rpassword">Repeat Password</label>
						<input type="password" class="form-control" id="rpassword" placeholder="Repeat Password" name="rpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
					</div>
				</div>	
			</div>

			<div id="message_p">
					<h6>Password must contain the following:</h6>
					<p id="letter_p" class="invalid">A <b>lowercase</b> letter</p>
					<p id="capital_p" class="invalid">A <b>capital (uppercase)</b> letter</p>
					<p id="number_p" class="invalid">A <b>number</b></p>
					<p id="length_p" class="invalid">Minimum <b>8 characters</b></p>
					<p id="match_r" class="invalid"><b>Repeat Password must Matched</b> with <b> Password</b></p>
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
						match_r.classList.remove("invalid");
						match_r.classList.add("valid");
						document.getElementById("sign_e").style.display = "inline";
						document.getElementById("sign_d").style.display = "none";
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
						match_r.classList.remove("invalid");
						match_r.classList.add("valid");
						document.getElementById("sign_e").style.display = "inline";
						document.getElementById("sign_d").style.display = "none";
					}			
				}
			</script>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Cancel</button>
				<button style="display: none; margin: 0;" id="sign_e" type="submit" name="signup" class="btn btn-success">Sign Up</button>
				<button style="margin: 0;" id="sign_d" type="submit" name="signup" class="btn btn-success" disabled>Sign Up</button>
			</div>
		</div>
 	</form>
</body>
</html>