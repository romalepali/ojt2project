<?php
if(isset($_POST['login'])){
	$query="SELECT * FROM users_list WHERE BINARY (username='$username' || email='$username') AND BINARY password='$password'";
	$result=mysqli_query($conn, $query);

	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_row($result)){
			$_SESSION['user_id']=$row[0];
			$_SESSION['user_type']=$row[1];
			$_SESSION['user_status']=$row[2];
			$_SESSION['search'] = "";
		}

		$type_query="SELECT * FROM users_type WHERE id=".$_SESSION['user_type'];
		$type_result=mysqli_query($conn, $type_query);
		$type_get=mysqli_fetch_array($type_result);
		?>
			<script type="text/javascript">
				swal({
					title: "Success!",
					text: "You are logged as <?php echo $type_get['type'];?>",
					type: "success",
					confirmButtonClass: "btn-primary",
					confirmButtonText: "OK",
					closeOnConfirm: false
				},
				function(isConfirm){
				if (isConfirm) {
					window.location='views/';
				}
			});
			</script>
		<?php
	}else {
	?>
		<script type="text/javascript">
			swal({
				title: "Failed!",
				text: "Incorrect Username/Password",
				type: "error",
				confirmButtonClass: "btn-primary",
				confirmButtonText: "OK",
				closeOnConfirm: false
			},
			function(isConfirm){
				if (isConfirm) {
					window.location='login.php';
				}
			});
		</script><?php
	}
}
?>