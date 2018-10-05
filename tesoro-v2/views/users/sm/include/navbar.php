<?php
	$user_query="SELECT * FROM users_list WHERE id=".$_SESSION['user_id'];
	$user_result=mysqli_query($conn,$user_query);
	$user=mysqli_fetch_array($user_result);
?>

<!DOCTYPE html>
<html>
<style type="text/css">
	.input-list {
		padding-left: 10px;
		font-size: 11px;
	}
	
	input {
		outline: none;
	}

	#searchbar input[type=search] {
		background: url('images/search-icon.png') #fff no-repeat 9px center;
		border: solid 1px #ccc;
		padding: 5px 4px 5px 32px;
		width: 0px;
		-webkit-border-radius: 10em;
		-moz-border-radius: 10em;
		border-radius: 10em;
		-webkit-transition: all .5s;
		-moz-transition: all .5s;
		transition: all .5s;
	}
			
	#searchbar input[type=search]:hover {
		background-color: #fff;
	}
			
	#searchbar input[type=search]:focus {
		width: 200px;
		padding-left: 32px;
		color: #000;
		background-color: #fff;
		cursor: auto;
	}
			
	#searchbar input:-moz-placeholder {
		color: transparent;
	}
		
	#searchbar input::-webkit-input-placeholder {
		color: transparent;
	}
		
	#searchbar{
		margin-top: 4px;
		margin-right: 4px;
	}
	
	.today{
		display: block;
	}
		
	@media (max-width: 768px) {
		.today{
			display: none;
		}
	}
</style>

<script>
	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var h2 = h%12;
		var m = today.getMinutes();
		var s = today.getSeconds();
		m = checkTime(m);
		s = checkTime(s);

		if(h > 12){
			if(h2 < 12){
				document.getElementById('txt').innerHTML =
				h2 + ":" + m + ":" + s + " PM";
			}else{
				document.getElementById('txt').innerHTML =
				h2 + ":" + m + ":" + s + " AM";
			}
		}else{
			if(h < 12){
				document.getElementById('txt').innerHTML =
				h + ":" + m + ":" + s + " AM";
			}else{
				document.getElementById('txt').innerHTML =
				h + ":" + m + ":" + s + " PM";
			}
		}
		
		var t = setTimeout(startTime, 500);
	}

	function checkTime(i) {
		if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		return i;
	}
</script>

<body onload="startTime()">
	<div id="wrapper">
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li class="sidebar-brand">
					<a href="index.php">
						<img src="images/TIMS_logo.png" width="100px">
					</a>
				</li>
				<div id="accordion1">
					<li>
						<a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						  Dashboard
						</a>
					</li>
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion1">
						<li>
							<a class="input-list nav-mactivity" href="#">My Activity</a>
						</li>
						<li>
							<a class="input-list nav-uactivity" href="#">Users Activity</a>
						</li>
					</div>
				</div>
				<div id="accordion2">
					<li>
						<a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
						  Manage
						</a>
					</li>
					<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
						<li>
							<a class="input-list nav-inputs" href="job_inputs.php">Job Inputs</a>
						</li>
						<li>
							<a class="input-list nav-jo" href="all_jobs.php?jobs=all">Job Orders</a>
						</li>
						<li>
							<a class="input-list nav-users" href="users.php?users=all">System Users</a>
						</li>
					</div>
				</div>				
			</ul>
		</div>

		<div style="background-color: #a90000;">
			<a href="#menu-toggle" class="btn btn-danger" id="menu-toggle">&#9776;</a>
			<div style="color: white;float: right;padding: 1px 8px;">
				<div id=txt style="font-size: 21px;font-weight: bold;"></div>
				<div style="margin-top:-8px;font-size:11px;"><?php  echo date('F d, Y')." (".date('l').")";?></div>
			</div>
		</div>
	</div>

	<div class="custom-nav">
        <div style="float: right; color: white;">
            <button type="button" class="btn btn-danger notify" data-toggle="dropdown">
                <img style="margin-top: -17px; margin-left: -17px; position: absolute; width: 35px; border-radius: 100px; height: 35px;" src="../uploads/images/<?php echo $user['picture'].".png";?>">
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">Account</div>
                <button class="dropdown-item" onclick="window.location='profile.php?type=view'">Profile</button>
                <button class="dropdown-item" onclick="logout()">Logout</button>
            </div>
        </div>
		
		<div style="float: right;">
			<form id="searchbar" action="search.php?search=jo" method="POST">
				<input type="search" name="search" placeholder="Search" value="<?php if(isset($_SESSION['search'])){echo $_SESSION['search'];}?>">
				<input name="search_submit" type="hidden">
			</form>
		</div>
	</div>

	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$("#notify-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper2").toggleClass("toggled");
	});

	$("#account-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper3").toggleClass("toggled");
	});
	</script>

	<script type="text/javascript">
		function logout(){
			swal({
			  title: "WARNING",
			  text: "Are you sure to logout your account!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Yes",
			  cancelButtonText: "No",
			  closeOnConfirm: false,
			  closeOnCancel: true
			},
			function(isConfirm) {
			  if (isConfirm) {
				window.location.href='logout.php';
			  }
			});
		}
	</script>
	<script src="js/inputs.js"></script>
</body>
</html>