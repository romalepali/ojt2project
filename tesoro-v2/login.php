<?php
	include ('config/verify.php');
	
	if(isset($_POST['signup']))
	{
		$type = 1;
		$status = 'Inactive';
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
			$_SESSION['gender'] = $gender = $_POST['gender'];
			?>
				<script type="text/javascript">
					alert('Passwords does not match!');
					window.location.href='login.php';
				</script>
			<?php
		}
		else{
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
				$_SESSION['gender'] = $gender = $_POST['gender'];

				?>
					<script type="text/javascript">
						alert('Account already exists!');
						window.location.href='login.php';
					</script>
				<?php
			}
			else{
				$sql_query = "INSERT INTO users_list (type,status,username,email,password,firstname,middlename,lastname,birthdate,gender,picture,added_on) VALUES ('$type','$status','$username','$email','$password','$fname','$mname','$lname','$bdate','$gender','$picture',NOW())";

				if(mysqli_query($conn,$sql_query))
				{
					$_SESSION['username'] = NULL;
					$_SESSION['email'] = NULL;
					$_SESSION['fname'] = NULL;
					$_SESSION['mname'] = NULL;
					$_SESSION['lname'] = NULL;
					$_SESSION['bdate'] = NULL;
					$_SESSION['gender'] = NULL;

					?> 
						<script type="text/javascript">
							alert('Successful, please verify it to the Maintenance Support!');
							window.location.href='login.php';
						</script>
					<?php
				}
				else
				{
					$_SESSION['username'] = $username = $_POST['username'];
					$_SESSION['email'] = $email = $_POST['email'];
					$_SESSION['fname'] = $fname = $_POST['fname'];
					$_SESSION['mname'] = $mname = $_POST['mname'];
					$_SESSION['lname'] = $lname = $_POST['lname'];
					$_SESSION['bdate'] = $bdate = $_POST['bdate'];
					$_SESSION['gender'] = $gender = $_POST['gender'];

					?>
						<script type="text/javascript">
							alert('Error occured while creating your account!');
							window.location.href='login.php';
						</script>
					<?php
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
	<title>JOMIS | Log In</title>
</head>
<body>
	<?php include ('include/login_fields.php'); ?>
</body>
</html>