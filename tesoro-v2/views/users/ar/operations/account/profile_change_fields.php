<?php
	if (isset($_POST['e_change']) && $_POST['e_change']=='true') {
		$old_pass = $_POST["old_pass"];
		$con_pass = $_POST["con_pass"];
		
		$en_con = MD5($con_pass);	
		$en_old = MD5($old_pass);
		if(strcmp($en_old,$profile['password']) != 0){
		?>
		<script type="text/javascript">
			swal({
				title: "Failed!",
				text: "Current password did not match",
				type: "error"
			},
			function(isConfirm) {
				if (isConfirm) {
					window.location.href='<?php echo $_SESSION['page'];?>';
				}
			});
		</script>
		<?php
		}else{
			$update_pass = "UPDATE users_list SET password='$en_con' WHERE id=".$_SESSION['user_id'];

			if(mysqli_query($conn,$update_pass)){
			?>
			<script type="text/javascript">
				swal({
					title: "Success!",
					text: "Your updates are applied",
					type: "success"
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>';
					}
				});
			</script>
			<?php
			}else{
			?>
			<script type="text/javascript">
				swal({
					title: "Failed!",
					text: "No updates applied",
					type: "error"
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>';
					}
				});
			</script>
			<?php
			}
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

if(isset($_POST['change']) && $_POST['change']=='true'){?>

<style type="text/css">
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

<form role="form" method="POST">
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Current Password</label>
		<div class="col-lg-7">
			<input class="form-control" type="password" placeholder="enter current password" name="old_pass" placeholder="Password" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required autofocus>
		</div>
		<div class="col-lg-3 mt-2">
			<div id="message" style="display: none;">
				<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
				<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
				<p id="number" class="invalid">A <b>number</b></p>
				<p id="length" class="invalid">Minimum <b>8 characters</b></p>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">New Password</label>
		<div class="col-lg-7">
			<input class="form-control" type="password" placeholder="enter new password" name="new_pass" placeholder="Password" id="psw_n" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
		</div>
		<div class="col-lg-3 mt-2">
			<div id="message_n" style="display: none;">
				<p id="letter_n" class="invalid">A <b>lowercase</b> letter</p>
				<p id="capital_n" class="invalid">A <b>capital (uppercase)</b> letter</p>
				<p id="number_n" class="invalid">A <b>number</b></p>
				<p id="length_n" class="invalid">Minimum <b>8 characters</b></p>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Confirm Password</label>
		<div class="col-lg-7">
			<input class="form-control" type="password" placeholder="enter confirm password" name="con_pass" placeholder="Password" id="psw_c" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"required>
		</div>
		<div class="col-lg-3 mt-2">
			<div id="message_c" style="display: none;">
				<p id="letter_c" class="invalid">A <b>lowercase</b> letter</p>
				<p id="capital_c" class="invalid">A <b>capital (uppercase)</b> letter</p>
				<p id="number_c" class="invalid">A <b>number</b></p>
				<p id="length_c" class="invalid">Minimum <b>8 characters</b></p>
				<p id="match_c" class="invalid"><b>Matched</b> with <b>new password</b></p>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label"></label>
		<div class="col-lg-10">
			<a href="profile.php?type=change" class="btn btn-secondary">Cancel</a>
			
			<button id="submit_d" type="submit" name="e_change" value="true" class="btn btn-primary" disabled>Save Changes</button>
			<button id="submit_a" style="display: none" type="submit" name="e_change" value="true" class="btn btn-primary">Save Changes</button>
		</div>
	</div>
</form>

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

		var myInput_n = document.getElementById("psw_n");
		var letter_n = document.getElementById("letter_n");
		var capital_n = document.getElementById("capital_n");
		var number_n = document.getElementById("number_n");
		var length_n = document.getElementById("length_n");

		myInput_n.onfocus = function() {
			document.getElementById("message_n").style.display = "block";
		}

		myInput_n.onblur = function() {
			document.getElementById("message_n").style.display = "none";
		}

		myInput_n.onkeyup = function() {
			if(myInput_c.value!=myInput_n.value) {  
				match_c.classList.remove("valid");
				match_c.classList.add("invalid");
				document.getElementById("submit_d").style.display = "inline";
				document.getElementById("submit_a").style.display = "none";
			} else {
				match_c.classList.remove("invalid");
				match_c.classList.add("valid");
				document.getElementById("submit_a").style.display = "inline";
				document.getElementById("submit_d").style.display = "none";
			}

			var lowerCaseLetters_n = /[a-z]/g;
			if(myInput_n.value.match(lowerCaseLetters_n)) {  
				letter_n.classList.remove("invalid");
				letter_n.classList.add("valid");
			} else {
				letter_n.classList.remove("valid");
				letter_n.classList.add("invalid");
			}

			var upperCaseLetters_n = /[A-Z]/g;
			if(myInput_n.value.match(upperCaseLetters_n)) {  
				capital_n.classList.remove("invalid");
				capital_n.classList.add("valid");
			} else {
				capital_n.classList.remove("valid");
				capital_n.classList.add("invalid");
			}

			var numbers_n = /[0-9]/g;
			if(myInput_n.value.match(numbers_n)) {  
				number_n.classList.remove("invalid");
				number_n.classList.add("valid");
			} else {
				number_n.classList.remove("valid");
				number_n.classList.add("invalid");
			}
  
			if(myInput_n.value.length >= 8) {
				length_n.classList.remove("invalid");
				length_n.classList.add("valid");
			} else {
				length_n.classList.remove("valid");
				length_n.classList.add("invalid");
			}
		}

		var myInput_c = document.getElementById("psw_c");
		var letter_c = document.getElementById("letter_c");
		var capital_c = document.getElementById("capital_c");
		var number_c = document.getElementById("number_c");
		var length_c = document.getElementById("length_c");

		myInput_c.onfocus = function() {
			document.getElementById("message_c").style.display = "block";
		}

		myInput_c.onblur = function() {
			document.getElementById("message_c").style.display = "none";
		}

		myInput_c.onkeyup = function() {
			if(myInput_c.value!=myInput_n.value) {  
				match_c.classList.remove("valid");
				match_c.classList.add("invalid");
				document.getElementById("submit_d").style.display = "inline";
				document.getElementById("submit_a").style.display = "none";
			} else {
				match_c.classList.remove("invalid");
				match_c.classList.add("valid");
				document.getElementById("submit_a").style.display = "inline";
				document.getElementById("submit_d").style.display = "none";
			}			

			var lowerCaseLetters_c = /[a-z]/g;
			if(myInput_c.value.match(lowerCaseLetters_c)) {  
				letter_c.classList.remove("invalid");
				letter_c.classList.add("valid");
			} else {
				letter_c.classList.remove("valid");
				letter_c.classList.add("invalid");
			}

			var upperCaseLetters_c = /[A-Z]/g;
			if(myInput_c.value.match(upperCaseLetters_c)) {  
				capital_c.classList.remove("invalid");
				capital_c.classList.add("valid");
			} else {
				capital_c.classList.remove("valid");
				capital_c.classList.add("invalid");
			}

			var numbers_n = /[0-9]/g;
			if(myInput_c.value.match(numbers_n)) {  
				number_c.classList.remove("invalid");
				number_c.classList.add("valid");
			} else {
				number_c.classList.remove("valid");
				number_c.classList.add("invalid");
			}
  
			if(myInput_c.value.length >= 8) {
				length_c.classList.remove("invalid");
				length_c.classList.add("valid");
			} else {
				length_c.classList.remove("valid");
				length_c.classList.add("invalid");
			}
		}
	</script>
<?php
}else{ ?>
<form role="form" method="POST">
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Current Password</label>
		<div class="col-lg-10">
			<input class="form-control" type="password" placeholder="enter current password" disabled>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">New Password</label>
		<div class="col-lg-10">
			<input class="form-control" type="password" placeholder="enter new password" disabled>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Confirm Password</label>
		<div class="col-lg-10">
			<input class="form-control" type="password" placeholder="enter confirm password" disabled>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label"></label>
		<div class="col-lg-10">
			<button type="submit" class="btn btn-primary" name="change" value="true">Change Password</button>
		</div>
	</div>
</form>
<?php }?>