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
	
	.index-z{
		z-index: 0;
	}

	#searchbar input[type=search] {
		outline: none;
		-webkit-appearance: textfield;
		-webkit-box-sizing: content-box;
		font-family: inherit;
		font-size: 100%;
		background: url('images/search-icon.png') #eee no-repeat 14px center;
		border: solid 1px #ccc;
		padding: 10px 15px 10px 15px;
		-webkit-border-radius: 10em;
		-moz-border-radius: 10em;
		border-radius: 10em;
		-webkit-transition: all .5s;
		-moz-transition: all .5s;
		transition: all .5s;
		width: 15px;
		color: transparent;
		cursor: pointer;
	}
			
	#searchbar input[type=search]:hover {
		background-color: #fff;
	}
			
	#searchbar input[type=search]:focus {
		background-color: #fff;
		border-color: #66CC75;
		-webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
		-moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
		box-shadow: 0 0 5px rgba(109,207,246,.5);
		width: 200px;
		padding-left: 40px;
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
						<img src="images/JOMIS_logo.png" width="100px">
					</a>
				</li>
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
						<li>
							<a class="input-list nav-reports" href="reports.php?reports=all">System Reports</a>
						</li>
					</div>
				</div>				
			</ul>
		</div>

		<div style="background-color: #a90000;">
			<a href="#menu-toggle" class="btn btn-danger" id="menu-toggle">&#9776;</a>
			<div class="today" style="color: white;float: right;padding: 1px 8px;">
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
				<button class="dropdown-item" onclick="window.location='profile.php?type=view'">My Profile</button>
                <button class="dropdown-item" data-toggle="modal" data-target="#about">About JOMIS</button>
                <button class="dropdown-item" onclick="logout()">Log Out</button>
            </div>
        </div>
	</div>
	
	<div style="position: fixed; z-index: 2; bottom: 5px; right: 5px;">
		<form id="searchbar" action="search.php?search=jo" method="POST">
			<input type="search" name="search" placeholder="Search" value="<?php if(isset($_SESSION['search'])){echo $_SESSION['search'];}?>">
			<input name="search_submit" type="hidden">
		</form>
	</div>
	
	<div class="modal fade" id="about">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content"><?php
				$si_query="SELECT a.app_name,a.app_version,a.app_status FROM system_info a ORDER BY a.updated_on DESC LIMIT 1";
				$si_result=mysqli_query($conn,$si_query);
				if(mysqli_num_rows($si_result)>0){
					while($si=mysqli_fetch_assoc($si_result)){?>
						<div class="modal-header">
							<h4 class="modal-title">About JOMIS</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">
							<div class="row">
								<div class="col">App Name</div>
								<div class="col"><?php echo $si['app_name'];?></div>
							</div>
							<div class="row">
								<div class="col">App Version</div>
								<div class="col">
									<?php echo $si['app_version'];?>
									<span class="badge badge-success"><?php echo $si['app_status'];?></span>
								</div>
							</div>
						</div><?php
					}
				}?>

				<div class="modal-footer">
					<div class="mr-auto">
						<button class="btn btn-secondary mt-1" style="color: white" onclick="window.location='about.php?type=update_system'">Update</button>
					</div>
					<button type="button" class="btn btn-danger mt-1" data-dismiss="modal">Close</button>
				</div>
			</div>
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
			  title: "Warning",
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
	<script src="js/system/user_profile.js"></script>
</body>
</html>