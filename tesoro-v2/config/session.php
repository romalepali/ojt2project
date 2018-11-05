<?php
	if(isset($_POST['login'])){
		$query="SELECT * FROM users_list WHERE BINARY (username='$username' || email='$username') AND BINARY password='$password'";
		$result=mysqli_query($conn, $query);

		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_row($result)){
				$_SESSION['user_id']=$row[0];
				$_SESSION['user_type']=$row[1];
				$_SESSION['user_status']=$row[2];
				$_SESSION['search'] = "";
			}
			
			if($_SESSION['user_status']=='Active'){?>
				<script type="text/javascript">
					window.location='views/';
				</script><?php
			} else {?>
				<script type="text/javascript">
					swal({
						title: "Account Existed",
						text: "Please verify your account to the Support Maintenance!",
						type: "info",
						confirmButtonClass: "btn-primary",
						confirmButtonText: "OK",
						closeOnConfirm: false
					},function(isConfirm){
						if (isConfirm) {
							window.location='login.php';
						}
					});
				</script><?php				
			}
		}else {?>
			<script type="text/javascript">
				swal({
					title: "Failed",
					text: "Incorrect Username/Password!",
					type: "error",
					confirmButtonClass: "btn-primary",
					confirmButtonText: "OK",
					closeOnConfirm: false
				},function(isConfirm){
					if (isConfirm) {
						window.location='login.php';
					}
				});
			</script><?php
		}
	}
?>